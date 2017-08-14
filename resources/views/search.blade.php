@extends('layouts.app')

@section('content')
  <h1 class="mb-4">Articulos</h1>

  @forelse ($articulos as $articulo)
  <div class="card mb-3">
    <div class="card-header">
      <a href='/articulos/{{ $articulo->id }}'>
        {{ $articulo->titulo }}
      </a>
    </div>
  </div>
  @empty
  <div class="card">
    <div class="card-block">
      <h2>Lo siento. No hay contenido relacionado.</h2>
    </div>
  </div>
  @endforelse
  <hr>
  <h1 class="mb-4">Dudas</h1>

  @forelse ($conversaciones as $conversacion)
  <div class="card mb-3">
    <div class="card-header">
      <a href='/conversaciones/{{ $conversacion->id }}'>
        {{ $conversacion->conversacion }}
      </a>
    </div>
  </div>
  @empty
  <div class="card">
    <div class="card-block">
      <h2>Lo siento. No hay dudas relacionadas.</h2>
    </div>
  </div>
  @endforelse
@endsection
