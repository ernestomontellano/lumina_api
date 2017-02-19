<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contenido extends Model
{

    protected $table = 'contenidos';
    protected $fillable = [
        'state',
        'contenido'
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
