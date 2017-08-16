@extends('layouts.app')

@section('content')
<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Esta es una versión antigua de esta página, editada el {{ $modificacion->created_at }}. La dirección URL es un enlace permanente a esta versión, que puede ser diferente de la versión actual.</h4>
</div>
<div class="card">
  <img class="card-img-top" src="{{ $modificacion->imagen }}" alt="{{ $modificacion->titulo }}" style="width:100%">
  <div class="card-block">
    <h1 class="card-title">{{ $modificacion->titulo }}</h1>
      <small class="text-muted">Escrito por: <a href="#">{{ $modificacion->user->name }}</a></small>
      <p class="card-text">{!! $modificacion->contenido !!}</p>
  </div>
</div>
<div class="col-lg-4 col-md-9 col-sm-12">
  <div class="card mt-3">
    <a href="/articulos/{{ $articulo->id }}/historial" class="btn btn-grad btn-success">Historial</a>
  </div>
</div>
@endsection
