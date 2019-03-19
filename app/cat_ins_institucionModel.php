<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_ins_institucionModel extends Model
{
  protected $table="cat_ins_institucion";
  protected $primaryKey='id_cat_inst';
  public $timestamps=false;
  protected $fillable=
  [
      'nombre_ins'
  ];
}
