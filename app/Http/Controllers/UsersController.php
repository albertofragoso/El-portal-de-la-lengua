<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Articulo;

class UsersController extends Controller
{
    /*public function show($usuario)
    {
      //throw new \Exception('Simulando un error');
      $user = User::where('id', $usuario)->firstOrFail();
      $articulos = Articulo::with('user')->latest()->paginate(10);

      return view('usuarios.show', [
        'user' => $user,
        'articulos' => $articulos,
      ]);
    }*/

    public function notifications(Request $request)
    {
      return $request->user()->notifications->take(5);
    }

    public function showNotifications(Request $request)
    {
      $notifications = $request->user()->notifications;
      //dd($notifications[1]->data);
      return view('usuarios.notifications', [
        'notifications' => $notifications,
      ]);
    }
}
