<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Articulo extends Model
{

    use Searchable;

    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function message()
    {
      return $this->hasMany(Message::class)->orderBy('created_at', 'desc');
      //return $this->hasMany(Message::class)->latest();
    }

    public function modificacion()
    {
      return $this->hasMany(Modificacion::class)->orderBy('created_at', 'desc');
    }

    //Intercepta el llamado de una propiedad en base de datos
    public function getImagenAttribute($imagen)
    {
      if (!$imagen || starts_with($imagen, 'http')) {
        return $imagen;
      }
      return \Storage::disk('public')->url($imagen);
    }

    public function toSearchableArray()
    {
      $this->load('user');
      return $this->toArray();
    }
}
