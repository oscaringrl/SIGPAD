<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_carreraModel extends Model
{
    protected $table='carrera';
    protected $primaryKey='id_carrera';
    public $timestamps=false;
    protected $fillable=['nombre_carrera','id_escuela'];
}
