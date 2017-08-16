@extends('layouts.app')

@section('content')
<h1 class="mb-4">Tus articulos</h1>

@forelse ($articulos as $articulo)
<div class="card mb-3">
  <div class="card-header">
    <a href='/articulos/{{ $articulo->id }}/actualizar'>
      {{ $articulo->titulo }}
    </a>
  </div>
</div>
@empty
<div class="card">
  <div class="card-block">
    <h2>No has creado artículos aún.</h2>
  </div>
</div>
@endforelse

@endsection
