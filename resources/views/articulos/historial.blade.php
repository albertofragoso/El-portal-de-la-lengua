@extends('layouts.app')

@section('content')
<h1 class="mb-4">Historial de {{ $articulo->titulo }} </h1>

@forelse ($articulo->modificacion as $mod)
<div class="card mb-3">
  <div class="card-header">
      <a href='/articulos/{{ $articulo->id }}/historial/{{ $mod->id}}'>
        {{ $mod->user->name }} hizo una modifcación el día {{ $mod->created_at}}
      </a>
  </div>
  <div class="card-block">
    <p class="card-text">{{$mod->descripcion}}</p>
  </div>
</div>
@empty
<div class="card">
  <div class="card-block">
    <h2>Nadie lo ha modificado aún.</h2>
  </div>
</div>
@endforelse
<div class="col-lg-4 col-md-9 col-sm-12">
  <div class="card mt-3">
    <a href="/articulos/{{ $articulo->id }}" class="btn btn-grad btn-success">Regresar</a>
  </div>
</div>
@endsection
