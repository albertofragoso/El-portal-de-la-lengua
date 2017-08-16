@extends('layouts.app')

@section('content')
<h1 class="mb-4">Todas las dudas</h1>

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
    <h2>No hay dudas aún.</h2>
  </div>
</div>
@endforelse

@endsection
