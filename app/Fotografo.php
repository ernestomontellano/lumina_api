<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotografo extends Model
{

    protected $table = 'fotografos';
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'biografia'
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
