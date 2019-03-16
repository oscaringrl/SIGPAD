<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dcn_postg_postgradoModel extends Model
{
    protected $table='dcn_postg_postgrado';
    protected $primaryKey='id_dcn_post';
    public $timestamps=false;

    protected $fillable=['abreviatura', 'nombre_p_grado', 'descripcion_p_grado', 'fecha_inicio', 'fecha_fin', 'id_cat_inst', 'id_cat_pa', 'id_dcn'];
}
