<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dcn_dip_diplomadosModel extends Model
{
  protected $table='dcn_dip_diplomado';
    protected $primaryKey='id_dcn_dip';
    public $timestamps=false;
    protected $fillable=
    [
      'nombre_diplomado',
      'descripcion_dip',
      'fecha_inicio_dip',
      'fecha_fin_dip',
      'id_cat_mod',
      'id_cat_inst',
      'id_cat_pa',
      'id_dcn'
    ];
}
