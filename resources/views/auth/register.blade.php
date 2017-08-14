@extends('layouts.login')

@section('content')
<h1 class="bd-title mb-4">Registrate</h1>
<form role="form" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="name">Nombre</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        @if ($errors->has('name'))
            <span class="form-control-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
        <label for="email">Correo electrónico</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

        @if ($errors->has('email'))
            <span class="form-control-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
      <label for="password">Contraseña</label>
      <input id="password" type="password" class="form-control" name="password" required>

        @if ($errors->has('password'))
            <span class="form-control-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        <label for="password-confirm">Confirma tu contraseña</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-grad btn-primary">
                Registrate
      </button>
    </div>
</form>
@endsection
