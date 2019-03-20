<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_tip_part_inv_tipo_participacion_investigacionModel extends Model
{
  protected $table='cat_tip_part_inv_tipo_participacion_investigacion';
  protected $primaryKey='id_cat_tip_part';
  public $timestamps=false;
  protected $fillable=['nombre_tip_part'];
}
