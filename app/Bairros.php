<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bairros extends Model
{
    protected $fillable = ['nome', 'cidades_id'];

    public function cidade()
    {
        return $this->belongsTo('App\Cidades', 'cidades_id');
    }
}
