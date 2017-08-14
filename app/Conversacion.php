<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Conversacion extends Model
{
    use Searchable;

    protected $guarded = [];
    public $table = "conversaciones";

    public function users()
    {
      return $this->belongsToMany(User::class);
    }

    public function mensajes()
    {
      return $this->hasMany(Mensaje::class)->orderBy('created_at', 'desc');
    }

}
