<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dcn_inv_investigacionModel extends Model
{
    protected $table='dcn_inv_investigacion';
    protected $primaryKey='id_dcn_inv';
    public $timestamps=false;
    protected $fillable=
        [
            'alumno',
            'tema',
            'fecha_inicio_inv',
            'fecha_fin_inv',
            'publicado',
            'revista',
            'url',
            'descripcion_inv',
            'id_cat_inst',
            'id_cat_pa',
            'id_cat_idi',
            'id_cat_tip_part',
            'id_dcn'
        ];
}
