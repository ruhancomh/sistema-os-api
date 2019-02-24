<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model
{
    protected $fillable = ['nome', 'estados_id'];

    public function estado()
    {
        return $this->belongsTo('App\Estados', 'estados_id');
    }
}
