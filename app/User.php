<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articulos()
    {
      return $this->hasMany(Articulo::class)->orderBy('created_at', 'desc');
    }

    public function socialProfiles()
    {
      return $this->hasMany(SocialProfile::class);
    }

    public function messages()
    {
      return $this->hasMany(Message::class)->orderBy('created_at', 'desc');
    }

    public function modificacion()
    {
      return $this->hasMany(Modificacion::class)->orderBy('created_at', 'desc');
    }

    public function scopeAdmins($query)
    {
        return $query->where('roll', 1);
    }

    public function scopeConversacion($query)
    {
      return $query->where('roll', 1);
    }

    public function scopeRespuesta($query, $user)
    {
      return $query->where('id', $user);
    }
}
