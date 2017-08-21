<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticuloRequest;
use App\Http\Requests\ModifyArticuloRequest;
use Illuminate\Http\Request;
use App\Articulo; //Modelo Articulo
use App\Notifications\ArticuloMessage;
use App\Message;
use App\User;
use App\Modificacion;
use App\Conversacion;
use App\Events\ArticleWasViewed;
use Illuminate\Support\Facades\Auth;

class ArticulosController extends Controller {
  public function show(Articulo $articulo) {

      //$articulo = Articulo::find($id);
      $articulos = Articulo::with('user')->firstOrFail();

      if (Auth::user()) {
        $articulos->Increment('view_count');
      }

      return view('articulos.show', [
        'articulo' => $articulo,
        'articulos' => $articulos,
      ]);
  }

  public function create(CreateArticuloRequest $request) {
    //Insert
    $user = $request->user();
    $imagen = $request->file('imagen');
    /*$contenido = preg_replace('&lt;',"<",preg_replace('&gt;',">",$request->input('articulo')));*/

    $articulo = Articulo::create([
      'user_id' => $user->id,
      'titulo' => $request->input('titulo'),
      //'contenido' => $contenido,
      'contenido' => $request->input('articulo'),
      //'imagen' => 'http://lorempixel.com/600/338/?'.mt_rand(0,1000)
      'imagen' => $imagen->store('articulos', 'public'),
    ]);

    //dd($articulo);
    return redirect('/articulos/'.$articulo->id);
  }

  public function update(Articulo $articulo, Request $request) {

    Articulo::where('id', $articulo->id)
            ->update([
            'titulo' => $request->input('titulo'),
            'contenido' => $request->input('articulo'),
             ]);

    return redirect('/articulos/'.$articulo->id.'/actualizar')->withSuccess('Articulo modificado.');
  }

  public function actualizar(Articulo $articulo) {
    return view('articulos.update', [
      'articulo' => $articulo,
    ]);
  }

  public function nuevo() {
      return view('articulos.create');
  }

  public function createMessage($articulo, Request $request) {

      $user = $request->user();
      $articulos = Articulo::where('id', $articulo)->firstOrFail();
      $writer = User::where('id', $articulos->user_id)->firstOrFail();

      //Validar input
      $this->validate($request, [
        'content' => 'required'
      ], [
        'content.required' => 'Lo siento. Debes escribir un mensaje.'
      ]);

      $message = Message::Create([
        'content' => $request->input('content'),
        'user_id' => $user->id,
        'articulo_id' => $articulo,
      ]);

      $writer->notify(new ArticuloMessage($user, $articulos));

      return redirect('/articulos/'.$articulo)->withSuccess('Mensaje enviado.');
  }

  public function search(Request $request) {

    $query = $request->input('query');
    //$articulos =  Articulo::with('user')->where('contenido', 'LIKE', "%$query%")->paginate(10);
    $articulos = Articulo::search($query)->get();
    //$articulos->load('user');
    $conversaciones = Conversacion::search($query)->get();
    //$conversaciones->load('user');
    return view('search', [
      'articulos' => $articulos,
      'conversaciones' => $conversaciones,
    ]);
  }

  public function messages(Articulo $articulo)
  {
    return $articulo->message->load('user');
  }

  public function modify(Articulo $articulo, ModifyArticuloRequest $request)
  {
    $user = $request->user();

    $contenido_old = $articulo->contenido;
    $titulo_old = $articulo->titulo;
    $imagen_old = $articulo->imagen;
    $user_old = $articulo->user->id;

    $new = Articulo::where('id', $articulo->id)->update([
     'user_id' => $user->id,
     'contenido' => $request->input('contenido'),
     'updated_at' => date('Y-m-d H:i:s'),
    ]);

    $modify = Modificacion::Create([
     'articulo_id' => $articulo->id,
     'user_id' => $user_old,
     'titulo' => $titulo_old,
     'imagen' => $imagen_old,
     'contenido' => $contenido_old,
     'descripcion' => $request->input('descripcion'),
    ]);

    return redirect('/articulos/'.$articulo->id)->withSuccess('Artículo modificado.');
  }

  public function historial (Articulo $articulo)
  {
    $articulo->load('modificacion');
    return view('articulos.historial', [
      'articulo' => $articulo,
    ]);
  }

  public function showOld (Articulo $articulo, Modificacion $modificacion){
    return view( 'articulos.old' , [
      'modificacion' => $modificacion,
      'articulo' => $articulo,
    ]);
  }

  public function showUpdate (Request $request) {
    $user = $request->user();

    $articulos = $user->load('articulos');
    return view('articulos.modificar', [
      'articulos' => $user->articulos,
    ]);
  }

  /*public function views () {
      $articulos = Articulo::all();

      return view('articulos.visitas', [
        'articulos' => $articulos,
      ]);
  }*/
}
