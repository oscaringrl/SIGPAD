<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class pdg_gru_grupoModel extends Model{
    protected $table='pdg_gru_grupo';
	protected $primaryKey='id_pdg_gru';
	public $timestamps=false;
		protected $fillable=
		[
			'id_cat_sta',
			'numero_pdg_gru',
			'correlativo_pdg_gru',
			'anio_pdg_gru',
			'ciclo_pdg_gru'
		];

//EJRG begin
    /**
     * Retornar coleccion de relaciones-estudiantes-grupo, relacion One to Many
     */
    public function relaciones_gru_est()
    {
        return $this->hasMany('App\pdg_gru_est_grupo_estudianteModel','id_pdg_gru','id_pdg_gru');
    }
    /**
     * Retornar la relacion-grupo-tdg, relacion One to One
     */
    public function relacion_gru_tdg()
    {
        return $this->hasOne('App\pdg_tra_gra_trabajo_graduacionModel','id_pdg_gru','id_pdg_gru');
    }
//EJRG end

	function getGrupos (){
		$resultado = DB::select('CALL sp_pdg_gru_select_gruposPendientesDeAprobacion();');
		return  $resultado;
	}
	function getGruposDocente ($idDocente){
		$resultado = DB::select('CALL sp_pdg_gru_select_gruposByDocente('.$idDocente.');');
		return  $resultado;
	}
	function getDetalleGrupo ($idGrupo){
		$resultado =DB::select('call sp_pdg_gru_grupoDetalleByID(:idGrupo);',
	    	array(
	        	$idGrupo,
	    	)
		);;
		return  $resultado;
	}	
	function aprobarGrupo ($idGrupo){
		DB::statement('call sp_pdg_gru_aprobarGrupoTGCoordinador(:idGrupo,@result);',
	    	array(
	        	$idGrupo,
	    	)
		);
		$errorCode = DB::select('select @result as resultado');
		return  $errorCode;
	}
	function getEtapas($idGrupo){
		$etapas=DB::select('call sp_pdg_getEtapasEvaluativasByGrupo(:idGrupo);',
	    	array(
	        	$idGrupo,
	    	)
		);
		return $etapas;
	}
	function enviarParaAprobacionSp($idGrupo){
		DB::select('call sp_pdg_enviarParaAprobacion(:idGrupo,@result);',
	    	array(
	        	$idGrupo,
	    	)
		);
		$errorCode = DB::select('select @result as resultado');
		return  $errorCode;
	}
	public static function deleteGrupoAndRelations($idGrupo){
        $result = 0;
        try{
            DB::table('pdg_gru_est_grupo_estudiante')->where('id_pdg_gru','=',$idGrupo)->delete();
            pdg_gru_grupoModel::destroy($idGrupo);
        } catch (\Exception $exception){
            $result = 1;
        }
        return $result;
    }

    public static function getEstadoGrupos($anio){
        $grupos = DB::select("
            SELECT 
			gru.id_pdg_gru,
			tra.id_pdg_tra_gra,
			gru.numero_pdg_gru,
			eta.nombre_cat_eta_eva,
			genEst.carnet_gen_est,
			genEst.nombre_gen_est,
			(SELECT count(*) from pdg_apr_eta_tra_aprobador_etapa_trabajo where aprobo = 1 AND id_pdg_tra_gra = tra.id_pdg_tra_gra ) as CantAprobadas,
			(SELECT count(*) from pdg_apr_eta_tra_aprobador_etapa_trabajo where  id_pdg_tra_gra = tra.id_pdg_tra_gra ) as totalEtapas
			from pdg_gru_grupo gru
			inner join pdg_tra_gra_trabajo_graduacion tra on tra.id_pdg_gru = gru.id_pdg_gru
			inner join pdg_apr_eta_tra_aprobador_etapa_trabajo apr on apr.id_pdg_tra_gra = tra.id_pdg_tra_gra
			inner join cat_eta_eva_etapa_evaluativa eta on eta.id_cat_eta_eva = apr.id_cat_eta_eva
			inner join pdg_gru_est_grupo_estudiante est on est.id_pdg_gru = gru.id_pdg_gru
			inner join gen_est_estudiante genEst on genEst.id_gen_est = est.id_gen_est
			where apr.inicio = 1 AND aprobo = 0 AND est.eslider_pdg_gru_est = 1 AND gru.anio_pdg_gru = :anio
			group by gru.id_pdg_gru,tra.id_pdg_tra_gra,gru.numero_pdg_gru,eta.nombre_cat_eta_eva,est.id_gen_est,genEst.carnet_gen_est,
			genEst.nombre_gen_est",
            array($anio)
        );
        return $grupos;
    }
    public static function getDetalleGrupos($anio){
        $grupos = DB::select("
                    SELECT 
                        (SELECT COUNT(*) FROM pdg_gru_est_grupo_estudiante gru2 WHERE gru2.id_pdg_gru = gru_est.id_pdg_gru) AS cantGru,
                        gru_est.id_pdg_gru 	AS idGru,
                        gru.numero_pdg_gru 	AS numGrupo,
                        sta.nombre_cat_sta	AS nomSta,
                        est.nombre_gen_est	AS nomEst,
                        gru_est.eslider_pdg_gru_est AS bLider
                    FROM
                        pdg_gru_grupo gru
                        INNER JOIN pdg_gru_est_grupo_estudiante gru_est ON (gru_est.id_pdg_gru=gru.id_pdg_gru)
                        INNER JOIN gen_est_estudiante est	ON (est.id_gen_est=gru_est.id_gen_est)
                        INNER JOIN cat_sta_estado sta	ON (sta.id_cat_sta=gru.id_cat_sta)
                    WHERE
                        gru.anio_pdg_gru = :anio
                    ORDER BY 
                        gru.numero_pdg_gru ASC, gru_est.eslider_pdg_gru_est DESC",
            array($anio)
        );
        return $grupos;
    }
}
