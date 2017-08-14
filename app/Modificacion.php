<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modificacion extends Model
{
    protected $guarded = [];
    public $table = "modificaciones";

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function articulo()
    {
      return $this->belongsTo(Articulo::class);
    }
}
