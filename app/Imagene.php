<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagene extends Model
{

    protected $table = 'imagenes';
    protected $fillable = [
        'nombre',
        'codigo',
        'imagen',
        'descripcion',
        'fotografos_id',
        'soportes_id'
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
