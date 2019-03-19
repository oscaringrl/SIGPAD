<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_gra_gradoModel extends Model
{
    protected $table="cat_grado";
    protected $primaryKey='id';
    public $timestamps=false;

    protected $fillable=['nombre_g', 'descripcion_g'];
}
