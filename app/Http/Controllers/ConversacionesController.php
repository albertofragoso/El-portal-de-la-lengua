<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConversacionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Mensaje;
use App\User;
use App\Conversacion;
use App\Notifications\ConversationMessage;
use App\Notifications\ConversationResponse;
use DB;

class ConversacionesController extends Controller
{
    public function create(CreateConversacionRequest $request)
    {
      $user = $request->user();
      $conversacion = $request->input('conversacion');
      $contenido = $request->input('mensaje');

      $conversacion = Conversacion::create([
        'conversacion' => $conversacion,
      ]);
      $conversacion->users()->attach($user);

      $mensaje = Mensaje::create([
        'user_id' => $user->id,
        'contenido' => $contenido,
        'conversacion_id' => $conversacion->id,
      ]);

      //Notificar usuarios nueva conversaciones
      //$admins = DB::table('users')->where('roll', 1)->get();
      $admins = User::admins()->get();
      Notification::send($admins, new ConversationMessage($user, $conversacion));

      return redirect('/conversaciones/'.$conversacion->id);
    }

    public function response(Conversacion $conversacion, Request $request) {
      $user = $request->user();
      $conversacion->users()->attach($user);
      $contenido = $request->input('mensaje');

      $this->validate($request, [
        'mensaje' => 'required',
      ], [
        'mensaje.required' => 'Lo siento. Debes escribir una respuesta.'
      ]);

      $mensaje = Mensaje::create([
        'user_id' => $user->id,
        'contenido' => $contenido,
        'conversacion_id' => $conversacion->id,
      ]);

      $users = DB::table('conversacion_user')->where('conversacion_id', $conversacion->id)->get(); //Uniques
      foreach ($users as $x)
      {
        if ($user->id != $x->user_id)
        {
          $user_conversacion = User::respuesta($x->user_id)->get();
          Notification::send($user_conversacion, new ConversationResponse($user, $conversacion));
        }
      }

      return redirect('/conversaciones/'.$conversacion->id)->withSuccess('Respuesta enviada.');
    }

    public function show(Conversacion $conversacion) {
      $conversacion->load('users', 'mensajes');
      //dd($conversacion);

      return view('conversaciones.show', [
        'conversacion' => $conversacion,
        //'user' => auth()->user(),
      ]);
    }

    public function showAll() {

        $conversaciones = Conversacion::all();
        return view('conversaciones.dudas', [
          'conversaciones' => $conversaciones,
        ]);
    }
}
