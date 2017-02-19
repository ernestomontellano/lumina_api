<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenestamanho extends Model
{

    protected $table = 'imagenestamanhos';
    protected $fillable = [
        'imagenes_id',
        'tamanhos_id',
        'preciobs',
        'preciosus',
        'disponible'
    ];
    protected $hidden = [];

    public function scopeTabla()
    {
        return $this->getTable();
    }

    public function scopeCampos()
    {
        return $this->getFillable();
    }

}
