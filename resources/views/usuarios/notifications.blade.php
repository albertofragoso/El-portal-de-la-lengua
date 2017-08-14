@extends('layouts.app')

@section('content')
<h1 class="mb-4">Notificaciones</h1>

@forelse ($notifications as $notification)
<div class="card mb-3">
  <div class="card-header">
    @if (array_key_exists('articulo', $notification->data))
      <a href='/articulos/{{ $notification->data["articulo"]["id"] }}'>
        {{ $notification->data["user"]["name"] }} ha comentado tu artículo: {{ $notification->data["articulo"]["titulo"] }}
      </a>
    @else
      <a href='/conversaciones/{{ $notification->data["conversacion"]["id"] }}'>
        {{ $notification->data["user"]["name"] }} ha respondido tu duda: {{ $notification->data["conversacion"]["titulo"] }}
      </a>
    @endif
  </div>
</div>
@empty
<div class="card">
  <div class="card-block">
    <h2>No tienes aún.</h2>
  </div>
</div>
@endforelse

@endsection
