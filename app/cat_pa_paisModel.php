<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_pa_paisModel extends Model
{
    protected $table='cat_pa_pais';
    protected $primaryKey='id_cat_pa';
    public $timestamps=false;
    protected $fillable=['nombre_pais'];
}
