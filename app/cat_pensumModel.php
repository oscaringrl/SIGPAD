<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_pensumModel extends Model
{
    protected $table='pensum';
    protected $primaryKey='id_pensum';
    public $timestamps=false;
    protected $fillable=['anio_pensum'];
}
