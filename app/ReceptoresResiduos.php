<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceptoresResiduos extends Model
{
    protected $fillable = ['residuos_id','receptores_id'];

    public function residuo()
    {
        return $this->belongsTo('App\Residuos','residuos_id', 'id');
    }

    public function receptor()
    {
        return $this->belongsTo('App\Receptores','receptores_id', 'id');
    }
}
