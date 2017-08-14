<?php

namespace App\Http\Controllers;

use App\Articulo;
use Illuminate\Http\Request;

class MessageController extends Controller
{
  public function messages(Articulo $articulo)
  {
    return $articulo->message;
  }
}
