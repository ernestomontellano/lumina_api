<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

    protected $table = 'usuarios';
    protected $fillable = [
        'email',
        'password',
        'nombre',
        'apellido'
    ];
    protected $hidden = [
        'reset_token',
        'reset_date'
    ];

    public function scopeTabla()
    {
        return $this->getTable();
    }

    public function scopeCampos()
    {
        return $this->getFillable();
    }

}
