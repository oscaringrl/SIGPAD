<?php

namespace App\Http\Controllers\TrabajoGraduacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use \App\pdg_ppe_pre_perfilModel;
use \App\gen_EstudianteModel;
use \App\pdg_gru_grupoModel;
use \App\cat_tpo_tra_gra_tipo_trabajo_graduacionModel;
use \App\cat_eta_eva_etapa_evalutativaModel;
use \App\cat_tpo_doc_tipo_documentoModel;
use \App\pdg_doc_documentoModel;
use \App\pdg_arc_doc_archivo_documentoModel;


class DocumentoController extends Controller{
	public function __construct(){
        $this->middleware('auth');
    }
    public function createDocumento($idEtapa,$idTipoDoc){
    	//VERIFICAMOS SI EXISTEN EN LA BASE DE DATOS ESOS ID
    	$etapa = cat_eta_eva_etapa_evalutativaModel::find($idEtapa);
    	$tipoDocumento = cat_tpo_doc_tipo_documentoModel::find($idTipoDoc);
    	if(empty($tipoDocumento) || empty($etapa) ){
    		//return "LOS PARAMETROS RECIBIDOS NO SON CORRECTOS";
        return view("error");
    	}else{ //LOS PARAMETROS VIENEN CORRECTAMENTE
    		return view('TrabajoGraduacion.DocumentoEtapaEvaluativa.create',compact('etapa','tipoDocumento','idEtapa','idTipoDoc'));
    	}
    }
    public function editDocumento($idEtapa,$idDocumento,$idTipoDoc){
          $etapa = cat_eta_eva_etapa_evalutativaModel::find($idEtapa);
          $tipoDocumento = cat_tpo_doc_tipo_documentoModel::find($idTipoDoc);
          $documento = pdg_doc_documentoModel::find($idDocumento);
          if(empty($tipoDocumento) || empty($etapa)){
    		return view("error");
    	}else{ //LOS PARAMETROS VIENEN CORRECTAMENTE
    		return view('TrabajoGraduacion.DocumentoEtapaEvaluativa.edit',compact('etapa','tipoDocumento','idEtapa','idTipoDoc','documento'));
    	}
    }

    public function store(Request $request){
    	$userLogin=Auth::user();
    	$estudiante = new gen_EstudianteModel();
	    $idGrupo = $estudiante->getIdGrupo($userLogin->user);
	    if ($idGrupo !="NA") {
	    	$grupo = pdg_gru_grupoModel::find($idGrupo);
	    	$anioGrupo = $grupo->anio_pdg_gru;
	    	$correlativo = $grupo->correlativo_pdg_gru_gru;
	    	//obtenemos el campo file definido en el formulario
	      	$file = $request->file('documento');
	       //obtenemos el nombre del archivo
	      	$nombre = "Grupo".$idGrupo."_".$anioGrupo."_".date('hms').$file->getClientOriginalName();
	       //indicamos que queremos guardar un nuevo archivo en el disco local
	        Storage::disk('Uploads')->put($nombre, File::get($file));
	        //movemos el archivo a la ubicación correspondiente segun grupo y años
	        if ($_ENV['SERVER'] =="win") {
	        	$nuevaUbicacion=$anioGrupo.'\Grupo'.$correlativo.'\Etapas\ '.$nombre;
	        }else{
	        	$nuevaUbicacion=$anioGrupo.'/Grupo'.$correlativo.'/Etapas/'.$nombre;
	        }
	        Storage::disk('Uploads')->move($nombre, trim($nuevaUbicacion));
	        $fecha=date('Y-m-d H:m:s');
	        $path= public_path().$_ENV['PATH_UPLOADS'];
	        //cambiamos a 0 el documento que esta activo actualmente de ese tipo
           $ultimoDocumentoInsertado = pdg_doc_documentoModel::where('id_cat_tpo_doc', $request['tipoDocumento'])
          						->where('id_pdg_gru', $idGrupo)
          						->orderBy('id_pdg_doc', 'desc')
          						->first();
          	if (!empty($ultimoDocumentoInsertado)) {
          		$archivo = pdg_arc_doc_archivo_documentoModel::where('id_pdg_doc', $ultimoDocumentoInsertado->id_pdg_doc)
          				   ->where('activo','1')
          				   ->first();
          		if (!empty($archivo)) {
          			$archivo->activo = 0;
          			$archivo->save();
          		}
          		
          	}	
           $lastIdDocumento = pdg_doc_documentoModel::create
            ([
                'id_pdg_gru'   				     => $idGrupo,
                'id_cat_tpo_doc'       			 => $request['tipoDocumento'],
                'fecha_creacion_pdg_doc'       	 => $fecha
            ]); 

            $lastIdArchivo = pdg_arc_doc_archivo_documentoModel::create
            ([
                'id_pdg_doc'					 => $lastIdDocumento->id_pdg_doc,
                'ubicacion_arc_doc'				 => $path.trim($nuevaUbicacion),
                'fecha_subida_arc_doc'			 => $fecha,
                'nombre_arc_doc'                 => $file->getClientOriginalName(),
                'activo'                         => 1
            ]);
           
            Session::flash('message','Documento Envíado correctamente!');
        	return Redirect::to('etapaEvaluativa/'.$request['etapa']);
	    }else{
	    	return "EL ESTUDIANTE NO HA CONFORMADO UN GRUPO DE  TRABAJO DE GRADUACIÓN";
	    }
       
    }

    public function update(Request $request,$id){
    	$userLogin=Auth::user();
    	$estudiante = new gen_EstudianteModel();
	    $idGrupo = $estudiante->getIdGrupo($userLogin->user);
	    if ($idGrupo !="NA") {
	    	$grupo = pdg_gru_grupoModel::find($idGrupo);
	    	$anioGrupo = $grupo->anio_pdg_gru;
	    	$correlativo = $grupo->correlativo_pdg_gru_gru;
	    	//obtenemos el campo file definido en el formulario
	      	$file = $request->file('documento');
	       //obtenemos el nombre del archivo
	      	$nombre = "Grupo".$idGrupo."_".$anioGrupo."_".date('hms').$file->getClientOriginalName();
	       //indicamos que queremos guardar un nuevo archivo en el disco local
	        Storage::disk('Uploads')->put($nombre, File::get($file));
	        //movemos el archivo a la ubicación correspondiente segun grupo y años
	        if ($_ENV['SERVER'] =="win") {
	        	$nuevaUbicacion=$anioGrupo.'\Grupo'.$correlativo.'\Etapas\ '.$nombre;
	        }else{
	        	$nuevaUbicacion=$anioGrupo.'/Grupo'.$correlativo.'/Etapas/'.$nombre;
	        }
	        Storage::disk('Uploads')->move($nombre, trim($nuevaUbicacion));
	        $fecha=date('Y-m-d H:m:s');
	        $path= public_path().$_ENV['PATH_UPLOADS'];
           	//traemos el documento a modificar
           	$documento = pdg_doc_documentoModel::find($id);
           	//traemos el archivo asociado que es el  ultimo activo de todos los de ese tipo 
           	$archivoDocumento = pdg_arc_doc_archivo_documentoModel::where('id_pdg_doc', $id)->first();
           	//Borramos el archivo anterior
	      	File::delete($archivoDocumento->ubicacion_arc_doc);	
          	$archivoDocumento->ubicacion_arc_doc =$path.$nuevaUbicacion;
          	$archivoDocumento->nombre_arc_doc = $file->getClientOriginalName();
          	$archivoDocumento->fecha_subida_arc_doc = $fecha;
          	$archivoDocumento->save();
            Session::flash('message','Documento Actualizado correctamente!');
        	return Redirect::to('etapaEvaluativa/'.$request['etapa']);
	    }else{
	    	// NO POSEE GRUPO
	    }
       
    }

    function downloadDocumento(Request $request){
    	$idArchvio = $request['documento'];
    	$archivoDocumento = pdg_arc_doc_archivo_documentoModel::find($idArchvio);
    	//verificamos si el archivo existe y lo retornamos
    	$ruta = $archivoDocumento->ubicacion_arc_doc;
     	if (File::exists($ruta)){
      	  return response()->download($ruta);
     	}else{
     		Session::flash('error','El documento no se encuentra disponible , es posible que haya sido  borrado');
            return Redirect::to('etapaEvaluativa/'.$request['etapa']);
     	}
    	//return $path;
    }

     public function destroy($id, Request $request){
    	$archivoDocumento = pdg_arc_doc_archivo_documentoModel::where('id_pdg_doc',$id)->first();
    	$idArchivo = $archivoDocumento->id_pdg_arc_doc;
    	//verificamos si el archivo existe y lo retornamos
    	$ruta = $archivoDocumento->ubicacion_arc_doc;
     	if (File::exists($ruta)){
      	  File::delete($ruta);	
     	}
     	pdg_arc_doc_archivo_documentoModel::destroy($idArchivo);
     	pdg_doc_documentoModel::find($id);
     	Session::flash('message','El documento se ha eliminado con éxito');
        return Redirect::to('etapaEvaluativa/'.$request['etapa']);

    } 

}
