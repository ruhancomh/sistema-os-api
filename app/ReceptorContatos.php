<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceptorContatos extends Model
{
    protected $fillable = [
        'nome',
        'cargo',
        'telefone',
        'email',
        'receptores_id'
    ];

    public function receptor() {
        return $this->belongsTo('App\Receptores', 'receptores_id');
    }
}
