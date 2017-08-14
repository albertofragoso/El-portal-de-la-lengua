@extends('layouts.app')

@section('content')
@if(Session('success'))
  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">{{ Session('success') }}</h4>
  </div>
@endif
<div class="card">
  <img class="card-img-top" src="{{ $articulo->imagen }}" alt="{{ $articulo->titulo }}" style="width:100%">
  <div class="card-block">
    <h1 class="card-title">{{ $articulo->titulo }}</h1>
      <small class="text-muted">Escrito por: <a href="#">{{ $articulo->user->name }}</a></small>
      <p class="card-text">{!! $articulo->contenido !!}</p>

      @if(Auth::check())
      <form action="/articulos/{{ $articulo->id }}/message" method="post">
        <div class="form-group {{ $errors->has('content') ? ' has-danger' : '' }}">
          {{ csrf_field() }}
          <input type="text" name="content" class="form-control mb-3" required autofocus>
          @if ($errors->has('content'))
            <div class="form-control-feedback mb-3">
                <strong>{{ $errors->first('content') }}</strong>
            </div>
          @endif
          <!--<input type="hidden" name="articulo_id" value="{{ $articulo->id }}">-->
          <button type="submit" class="btn btn-grad btn-success">Comentar</button>
      </div>
    </form>
    @endif
  </div>
</div>
@if(Auth::check())
<div class="row">
  <div class="col-lg-4 col-md-9 col-sm-12">
    <div class="card mt-3">
      <a class="btn btn-grad" data-toggle="collapse" href="#messages">Ver mensajes</a>
    </div>
  </div>
  <div class="col-lg-4 col-md-9 col-sm-12">
    <div class="card mt-3">
      <a data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-grad" role="button"> Modificar</a>
    </div>
  </div>
  <div class="col-lg-4 col-md-9 col-sm-12">
    <div class="card mt-3">
      <a href="/articulos/{{ $articulo->id }}/historial" class="btn btn-grad btn-success">Historial</a>
    </div>
  </div>
</div>
<message :id="{{ $articulo->id }}"></message>
<!--Modal modificacion-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición de {{ $articulo->titulo }}.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/articulos/{{ $articulo->id }}/modificar" method="post">
        <div class="modal-body">
          {{ csrf_field() }}
          <div class="form-group {{ $errors->has('descripcion') ? ' has-danger' : '' }}">
            <label for="recipient-name" class="form-control-label">Resumen</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            @if ($errors->has('descripcion'))
              <div class="form-control-feedback">
                  <strong>{{ $errors->first('descripcion') }}</strong>
              </div>
            @endif
          </div>
          <div class="form-group {{ $errors->has('contenido') ? ' has-danger' : '' }}">
            <textarea class="form-control" id="contenido" name="contenido" rows="30" required>
              {!! $articulo->contenido !!}
            </textarea>
          </div>
          <small class="text-muted">Al editar páginas, aceptas todos nuestros términos de uso.</small>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-grad">¡Listo!</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
<script>tinymce.init({
  selector: 'textarea',
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'undo redo | styleselect | bold italic | bullist numlist outdent indent | link image',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});
</script>
@endif
@endsection
