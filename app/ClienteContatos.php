<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteContatos extends Model
{
    protected $fillable = [
        'nome',
        'cargo',
        'telefone',
        'email',
        'clientes_id'
    ];

    public function cliente() {
        return $this->belongsTo('App\Clientes', 'clientes_id');
    }
}
