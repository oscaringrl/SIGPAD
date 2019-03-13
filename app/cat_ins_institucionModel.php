<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_ins_institucionModel extends Model
{
  protected $table="dcn_ins_institucion";
  protected $primaryKey='id';
  public $timestamps=false;
  protected $fillable=
  [
      'nombre_ins'
  ];
}
