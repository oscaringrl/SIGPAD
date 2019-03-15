<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_mod_modalidadModel extends Model
{
    protected $table="cat_mod_modalidad";
    protected $primaryKey='id_cat_mod';
    public $timestamps=false;
    protected $fillable=
    [
        'nombre_modalidad'
    ];
}
