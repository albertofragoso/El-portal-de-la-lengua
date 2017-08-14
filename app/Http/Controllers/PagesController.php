<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo; //Modelo de Articulo

class PagesController extends Controller
{
    public function home() {

      $articulos = Articulo::with('user')->latest()->paginate(10);

      return view('welcome', [
        'articulos' => $articulos,
      ]);
    }

    public function creditos() {
      return view('creditos');
    }
}
