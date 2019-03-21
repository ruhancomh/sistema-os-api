<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'nome', 'email', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token','created_at', 'updated_at', 'id'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
