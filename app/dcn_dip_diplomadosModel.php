<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dcn_dip_diplomadosModel extends Model
{
  protected $table='dcn_dip_diplomados';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable=
    [
      'nombre_diplomado',
      'descripcion_diplomado',
      'fecha_inicio_diplomado',
      'fecha_fin_diplomado',
      'id_ins'
      'id_dcn'
    ];
}
}
