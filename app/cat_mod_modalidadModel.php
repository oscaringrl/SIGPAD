<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_mod_modalidadModel extends Model
{
    protected $table="cat_modalidad";
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable=
    [
        'nombre_modalidad'
    ];
}
