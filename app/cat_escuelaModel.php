<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_escuelaModel extends Model
{
    protected $table='escuela';
    protected $primaryKey='id_escuela';
    public $timestamps=false;
    protected $fillable=['nombre_escuela'];
}
