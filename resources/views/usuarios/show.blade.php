@extends('layouts.app')

@section('content')
<h1>{{ $user->name }}</h1>

<div class="row mt-4">
  @foreach($user->articulos as $articulo)
  <div class="col-6">
    <img class="img-thumbnail mb-3" src="{{ $articulo->imagen }}" />
    <h2>{{ $articulo->titulo }}</h2>
    <p class="mt-3">{{ $articulo->contenido }}</p>
    <small class="text-muted float-right">{{ $articulo->created_at }}</small>
    <p><a class="btn btn-grad btn-secondary" href="/articulos/{{ $articulo->id }}" role="button">Leer más »</a></p>
  </div>
  @endforeach
</div>
@endsection
