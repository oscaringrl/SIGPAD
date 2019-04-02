<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_materiaModel extends Model
{
    protected $table='materia';
    protected $primaryKey='id_materia';
    public $timestamps=false;
    protected $fillable=[
    'codigo_materia',
    'nombre_materia',
    'es_electiva',
    'id_pensum',
    'id_carrera'];
}
