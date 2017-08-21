@extends('layouts.app')

@section('content')
<h1 class="mb-4">Tus articulos</h1>

@forelse ($articulos as $articulo)
<div class="card mb-3">
  <div class="card-header">
    <a href='/articulos/{{ $articulo->id }}/actualizar'>
      <h5>{{ $articulo->titulo }}</h5>
    </a>
  </div>
  <div class="card-footer">
    <small>Número de visitas: {{ $articulo->view_count }}</small>
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
