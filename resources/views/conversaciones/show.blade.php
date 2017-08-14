@extends('layouts.app')

@section('content')
<h1 class="mb-4">Duda del idioma: {{ $conversacion->conversacion }}</h1>

@if(Session('success'))
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">{{ Session('success') }}</h4>
  </div>
@endif

@foreach($conversacion->mensajes as $mensaje)
<div class="card mb-3">
  <div class="card-header">
    <a href="#">{{ $mensaje->user->name }}</a> dijo:
  </div>
  <div class="card-block">
    {{ $mensaje->contenido }}
  </div>
  <div class="card-footer">
    {{ $mensaje->created_at }}
  </div>
</div>
@endforeach

<form method="post" action="/conversaciones/{{ $conversacion->id }}/response">
  {{ csrf_field() }}
  <div class="form-group mt-5 {{ $errors->has('mensaje') ? ' has-danger' : '' }}">
    <label for="message-text" class="form-control-label">Respuesta:</label>
    <textarea class="form-control" id="mensaje" name="mensaje"></textarea>
    @if ($errors->has('mensaje'))
      <div class="form-control-feedback">
          <strong>{{ $errors->first('mensaje') }}</strong>
      </div>
    @endif
    <button type="submit" class="btn btn-grad mt-3">Enviar</button>
  </div>
</form>

@endsection
