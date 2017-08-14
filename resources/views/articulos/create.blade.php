@extends('layouts.login')

@section('content')
<h1 class="bd-title mb-4">Crear nuevo artículo</h1>
<form class="" action="/articulos/create" method="post" enctype="multipart/form-data">
 {{ csrf_field() }}
 <div class="form-group {{ $errors->has('titulo') ? ' has-danger' : '' }}">
   <label for="titulo">Título</label>
   <input id="titulo" type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
   @if ($errors->has('titulo'))
     <div class="form-control-feedback">
         <strong>{{ $errors->first('titulo') }}</strong>
     </div>
   @endif
 </div>
 <div class="form-group {{ $errors->has('articulo') ? ' has-danger' : '' }}">
   <label for="articulo">Contenido</label>
   <textarea class="form-control" id="articulo" name="articulo" rows="20">{{ old('articulo') }}</textarea>
   @if ($errors->has('articulo'))
     <div class="form-control-feedback">
         <strong>{{ $errors->first('articulo') }}</strong>
     </div>
   @endif
 </div>
 <div class="form-group @if($errors->has('imagen')) has-danger @endif">
   <label class="custom-file">
    <input type="file" id="imagen" name="imagen" class="custom-file-input">
    <span class="custom-file-control"></span>
    @if($errors->has('imagen'))
        <div class="form-control-feedback">
          <strong>{{ $errors->first('imagen') }}</strong>
        </div>
    @endif
  </label>
</div>
<div class="form-group">
   <button type="submit" class="btn btn-grad">
             ¡Listo!
   </button>
 </div>
</form>
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
@endsection
