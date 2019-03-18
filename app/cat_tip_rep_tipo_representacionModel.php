<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_tip_rep_tipo_representacionModel extends Model
{
    protected $table='cat_tip_rep_tipo_representacion';
    protected $primaryKey='id_cat_tip_rep';
    public $timestamps=false;
    protected $fillable=['nombre_tip_repre'];
}
