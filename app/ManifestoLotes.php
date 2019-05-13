<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManifestoLotes extends Model
{
    protected $fillable = [
        'manifestos_id_principal',
        'manifestos_id_vinculado'
    ];

    public function manifestoPrincipal()
    {
        return $this->belongsTo('App\Manifestos', 'id', 'manifestos_id_principal');
    }

    public function manifestoVinculado()
    {
        return $this->hasOne('App\Manifestos', 'id', 'manifestos_id_vinculado');
    }
}
