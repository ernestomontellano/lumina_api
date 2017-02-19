<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soporte extends Model
{

    protected $table = 'soportes';
    protected $fillable = [
        'soporte'
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
