<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ManifestoLotes extends Model
{
    protected $fillable = [
        'manifestos_id_principal',
        'manifestos_id_vinculado'
    ];

    protected function setKeysForSaveQuery(Builder $query)
    {
        $query
            ->where('manifestos_id_principal', '=', $this->getAttribute('manifestos_id_principal'))
            ->where('manifestos_id_vinculado', '=', $this->getAttribute('manifestos_id_vinculado'));
        return $query;
    }

    public function manifestoPrincipal()
    {
        return $this->belongsTo('App\Manifestos', 'id', 'manifestos_id_principal');
    }

    public function manifestoVinculado()
    {
        return $this->hasOne('App\Manifestos', 'id', 'manifestos_id_vinculado');
    }
}
