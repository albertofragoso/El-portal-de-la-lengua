@extends('layouts.login')

@section('content')
<h1 class="bd-title mb-4">Entrar</h1>
<form role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
      <label for="email">Correo electrónico</label>
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
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
      <div class="checkbox">
          <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
          </label>
      </div>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-grad btn-primary">
          Entrar
      </button>
      <a class="btn btn-link" href="{{ route('password.request') }}">
          ¿Olvidaste tu contraseña? No te preocupes.
      </a>
    </div>
</form>
<hr>
<div class="mt-5 text-center">
  <a href="/auth/facebook" class="btn btn-grad btn-primary">Login con Facebook</a>
</div>
@endsection
