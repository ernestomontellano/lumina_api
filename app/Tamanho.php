<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamanho extends Model
{

    protected $table = 'tamanhos';
    protected $fillable = [
        'tamanho'
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
