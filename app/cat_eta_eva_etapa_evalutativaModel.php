<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class cat_eta_eva_etapa_evalutativaModel extends Model{
    protected $table='cat_eta_eva_etapa_evaluativa';
	protected $primaryKey='id_cat_eta_eva';
	public $timestamps=false;
		protected $fillable=
		[
			'nombre_cat_eta_eva',
			'ponderacion_cat_eta_eva',
			'tiene_defensas_cat_eta_eva',
			'anio_cat_eta_eva',
			'puede_observar_cat_eta_eva'
            ,'notagrupal_cat_eta_eva'
		];

	public function relEtapaTrabajo(){
       return $this->hasOne('App\rel_tpo_tra_eta_tipo_trabajo_etapaModel','id_cat_eta_eva','id_cat_eta_eva');
    }
	function getDocumentos($idEtapa,$idTragra){
		$documentos=DB::select('call sp_pdg_getDocumentosByEtapa(:idEtapa,:idTraGra);',
	    	array(
	        	$idEtapa,
	        	$idTragra
	    	)
		);
		return $documentos;
	}	

	function getArchivos($idEtapa,$idGrupo){
		$archivos=DB::select('call sp_pdg_getDocumentosArchivosEtapasByIdEtapaGrupo(:idEtapa,:idGrupo);',
	    	array(
	        	$idEtapa,
	        	$idGrupo
	    	)
		);
		return $archivos;
	}
    public function getFullNameAttribute()
    {
        return $this->nombre_cat_eta_eva. ' - ' . $this->anio_cat_eta_eva;
    }

    public static function getEtapasEvaluativas(){
    	$etapas=DB::select('
    		select 
			etapa.id_cat_eta_eva,
			etapa.nombre_cat_eta_eva,
			relTipo.id_cat_tpo_tra_gra
			from cat_eta_eva_etapa_evaluativa etapa
			inner join rel_tpo_tra_eta_tipo_trabajo_etapa relTipo on etapa.id_cat_eta_eva = relTipo.id_cat_eta_eva;');
		return $etapas;
    }


}
