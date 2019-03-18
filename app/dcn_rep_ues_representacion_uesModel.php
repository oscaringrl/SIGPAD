<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dcn_rep_ues_representacion_uesModel extends Model
{
    protected $table='dcn_rep_ues_representacion_ues';
    protected $primaryKey='id_dcn_rep';
    public $timestamps=false;

    protected $fillable=['evento_re_ues', 'descripcion_re_ues', 'mision_oficial', 'fecha_inicio_rep', 'fecha_fin_rep', 'id_cat_inst', 'id_cat_pa', 'id_cat_tip_rep', 'id_dcn'];
}
