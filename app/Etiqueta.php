<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{

    protected $table = 'etiquetas';
    protected $fillable = [
        'etiqueta'
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
