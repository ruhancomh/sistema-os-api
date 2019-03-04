<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportadorContatos extends Model
{
    protected $fillable = [
        'nome',
        'cargo',
        'telefone',
        'email',
        'transportadores_id'
    ];

    public function transportador() {
        return $this->belongsTo('App\Transportadores', 'transportadores_id');
    }
}
