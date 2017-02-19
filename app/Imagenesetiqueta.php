<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenesetiqueta extends Model
{

    protected $table = 'imagenesetiquetas';
    protected $fillable = [
        'imagenes_id',
        'etiquetas_id'
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
