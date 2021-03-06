<?php

namespace App\Http\Controllers\TrabajoGraduacion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Session;
use Redirect;
use Exception;
use \App\gen_UsuarioModel;
use \App\gen_EstudianteModel;
use \App\pdg_gru_est_grupo_estudianteModel;
use \App\pdg_gru_grupoModel;
use \App\User;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;

class ConformarGrupoController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }
	/**
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $userLogin=Auth::user();
        if ($userLogin->can(['grupo.index'])) {
            $grupo = new pdg_gru_grupoModel();
            $grupos= $grupo->getGrupos();
            //return var_dump($grupos);
       return view('TrabajoGraduacion.ConformarGrupo.index',compact(['grupos']));
        }else{
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return  view('template');
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
     if (Auth::user()->isRole('administrador_tdg')){
        return redirect('grupo');
     }else{
        $miGrupo = pdg_gru_grupoModel::getIdGrupo(Auth::user()->user);
        session(['idGrupo' => $miGrupo ]); 
       $cards="";
       $enviado =0;
       $cantidadMinima = 4;

       $idMiGrupo = session('idGrupo');
       if ($idMiGrupo == 0) {  //NO TIENE GRUPO U OCURRIO UNA EXCEPCION
            return view('TrabajoGraduacion.ConformarGrupo.create',compact(['cantidadMinima']));
       }elseif ($idMiGrupo == -1) {
           Session::flash('message-error','No te encuentras disponible para conformar un grupo de trabajo de graduación, consulta a la Coordinación.');
           return redirect('/');
       } 

       $estudiante = new gen_EstudianteModel();
       $miCarnet=Auth::user()->user;
       $respuesta =$estudiante->getGrupoById($idMiGrupo)->getData();  //getdata PARA CAMBIAR LOS VALORES DEL JSON DE PUBLICOS A PRIVADOS
       if ($respuesta->errorCode == '0') {
            $estudiantes=json_decode($respuesta->msg->estudiantes);//decode string to json
            $cantidadEstudiantes = sizeof($estudiantes);
            $contadorAceptado = 0;
            $idGrupo = -1;
            foreach ($estudiantes as $estudiante ) { 
                $idGrupo = $estudiante->idGrupo;
                $card='';
                $card.='<div class="col-sm-4" id="card'.$estudiante->carnet.'">';
                $card.='<div class="card border-primary mb-3">';
                if ( $estudiante->lider == 1){
                        $card.='<h5 class="card-header"><b>'.strtoupper($estudiante->carnet).'</b> - '.$estudiante->nombre.' <span class="badge badge-info">LIDER</span> </h5>';
                }else{
                        $card.='<h5 class="card-header"><b>'.strtoupper($estudiante->carnet).'</b> - '.$estudiante->nombre.'</h5>';
                }
                $card.='<div class="card-body">';
                $card.='<table>
                            <tr>
                                ';
                 if ($miCarnet == $estudiante->carnet && $estudiante->estado == "5" ) { //si soy el líder automaticamente ya acepte, tipoDocumento 5 no aceptado , tipoDocumento 6 aceptado
                    $card.='    <td>
                                    <h5 class="card-title">Estado</h5>
                                    <p class="card-text">Agregado al grupo</p><br>
                                </td>
                                <td>
                                 <button id="btnConfirmar" type="button" data-id="'.$estudiante->id.'" class="btn btn-success">
                                    <i class="fa fa-check" ></i>
                                </button>&nbsp;&nbsp;
                                <button id="btnDenegar" type="button"  data-id="'.$estudiante->id.'" class="btn btn-danger">
                                    <i class="fa fa-remove"></i>
                                </button>
                            
                           ';
                }else if($estudiante->estado == "6"){ //ACEPTO
                    $contadorAceptado+=1;
                    if ($estudiante->lider == 2) {
                        $card.='<td>
                                    <h5 class="card-title">Estado</h5>
                                    <p class="badge badge-danger card-text">RETIRADO</p><br>
                                </td>
                                <td>';
                    }else{
                        $card.='<td>
                                    <h5 class="card-title">Estado</h5>
                                    <p class="badge badge-success card-text">Confirmado</p><br>
                                </td>
                                <td>';
                    }
                    
                    
                }else{
                    $card.='<td>
                                    <h5 class="card-title">Estado</h5>
                                    <p class="badge badge-secondary card-text">Pendiente de Confirmar</p><br>
                                </td>
                                <td>';
                }
                $card.='</td>
                            </tr>
                        </table>';  
                $card.='</div></div></div>'; 
                $cards.=$card;                  
            }
            $grupo = pdg_gru_grupoModel::find($idGrupo);
            $estadoGrupo = $grupo->id_cat_sta;
            if ($cantidadEstudiantes == $contadorAceptado) {
                $enviado = 1 ; //EL GRUPO YA ESTA LISTO PARA SER ENVIADO
            }
           return view('TrabajoGraduacion.ConformarGrupo.create',compact(['cards','enviado','cantidadMinima','cantidadEstudiantes','idGrupo','estadoGrupo']));
       }else if($respuesta->errorCode == '1'){
            return view('TrabajoGraduacion.ConformarGrupo.create',compact(['cantidadMinima']));
       }else{
            return view('TrabajoGraduacion.ConformarGrupo.create',compact(['cantidadMinima']));
       }
        //return view('TrabajoGraduacion\ConformarGrupo.create',compact(['respuesta']));
       return $cards;
     }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $xmlRequest="";
        $xmlRequest.="<carnets>";
        foreach ($request['estudiantes'] as  $estudiante) {
            $xmlRequest.="<carnet>";
            $xmlRequest.=$estudiante;
            $xmlRequest.="</carnet>";
        }
        $xmlRequest.="</carnets>";
        $estudiante = new gen_EstudianteModel();
        $respuesta = $estudiante->conformarGrupoSp($xmlRequest);
        if ($respuesta[0]->resultado == '0' ) {
            $usuarioLider = Auth::user()->user;
            $estObj = gen_EstudianteModel::where('carnet_gen_est','=',$usuarioLider)->first();
            $estObj->disponible_gen_est = 0;
            $estObj->save();
            Session::flash('message','Grupo conformado correctamente!');
             return redirect()->route('grupo.create');
        }else{
            Session::flash('message-error','Se registro un problema al registrar el grupo , pruebe mas tarde.');
             return redirect()->route('grupo.create');
        }
    
        return $respuesta; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $respuesta = "";
            try {
                $grupo= new pdg_gru_grupoModel();
                $resultado = $grupo->getDetalleGrupo($id);
                $respuesta='
                    <div class="table-responsive">
                        <table class="table table-hover table-striped  display" id="listTable">
                            <thead>
                                <th>Carnet</th>
                                <th>Nombre</th>
                                <th>Cargo</th>
                            </thead>
                            <tbody>';
                          
                foreach ($resultado as $estudiante) {
                    $respuesta.='
                        <tr>
                        <td>'.$estudiante->carnet.'</td>
                        <td>'.$estudiante->Nombre.'</td>
                        <td>'.$estudiante->Cargo.'</td>
                        </tr>';
                }
                $respuesta.=' 
                            </tbody>
                        </table>
                    </div>';
                $btnHTML="";
                $btnEditHTML="";/*EJRG edit*/
                $grupo=pdg_gru_grupoModel::find($id);
                if ($grupo->id_cat_sta=='7') {
                    $btnHTML.='<button type="submit" class="btn btn-primary">Aprobar';
                    $btnHTML.='<input type="hidden" name="idGrupo" value="'.$id.'">';//Input adentro del btn p/no dañar roundcorners
                    $btnHTML.='</button>';
/*EJRG begin*/
                    $btnEditHTML.='<button type="submit" class="btn btn-secondary">Editar';
                    $btnEditHTML.='<input type="hidden" name="idGrupo" value="'.$id.'"/>';//Input adentro del btn p/no dañar roundcorners
                    $btnEditHTML.='</button>';
/*EJRG end*/
                }
                   return response()->json(['htmlCode'=>$respuesta,'btnHtmlCode'=>$btnHTML,'btnEditHtmlCode'=>$btnEditHTML]);
               // return $respuesta;
            } catch (Exception $e) {
               Session::flash('message','Ocurrió un problema al momento de obtener el grupo de trabajo de graduación!');
               Session::flash('tipo','error');
               return redirect()->route('grupo.index',compact());
            }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $res = pdg_gru_grupoModel::deleteGrupoAndRelations($id);
        Session::flash($res==0?'message-warning':'message-error',$res==0?'Grupo eliminado con éxito':'No es posible eliminar el grupo');
        return redirect()->route('grupo.index');
    }

    public function getAlumno(Request $request) 
    {
        if ($request->ajax()) {
           $estudiante=gen_EstudianteModel::where('carnet_gen_est', '=',$request['carnet'])->get();
           
           if (sizeof($estudiante) == 0){
            return response()->json(['errorCode'=>1,'errorMessage'=>'No se encontró ningún Alumno con ese Carnet','msg'=>""]);
           }else{
             return response()->json(['errorCode'=>0,'errorMessage'=>'Alumno agregado a grupo de Trabajo de Graduación','msg'=>$estudiante]);
           }
           
        }
       
    }
   
    public function verificarGrupo(Request $request) {
        if ($request->ajax()) {
            $estudiante = new gen_EstudianteModel();
            $respuesta = $estudiante->getGrupoCarnet($request['carnet']);
            return $respuesta; 
        }
    }
     
    public function confirmarGrupo(Request $request) { // Confirmar grupo de trabajo de graduación por parte del alumno
       if ($request->ajax()){
            try{
                  $estudianteGrupo= new pdg_gru_est_grupo_estudianteModel(); //mandamos id de estudiante
                  $resultado= $estudianteGrupo ->cambiarEstadoGrupo($request['id'],$request['aceptar']);
                  if ($resultado == "0"){
                         return response()->json(['errorCode'=>0,'errorMessage'=>'Has confirmado que perteceneces a este grupo de trabajo de graduación','msg'=>$resultado]);
                  }else
                  {  
                     session(['idGrupo' => 0 ]);
                     return response()->json(['errorCode'=>2,'errorMessage'=>'Has rechazado pertenecer al grupo de trabajo de graduación','msg'=>$resultado]);

                  }
                  
                }
            catch(\Exception $e){
               return response()->json(['errorCode'=>1,'errorMessage'=>'Ha ocurrido un error al procesar su petición de grupo de trabajo de graduación','msg'=>$e]);
            }
       } 
    }
    public function enviarGrupo(Request $request){
        
      try {
            $grupo =new pdg_gru_grupoModel();
            $resultado = $grupo->enviarParaAprobacionSp($request['idGrupo']);
            if ($resultado[0]->resultado == '0') {
                Session::flash('message','Se envió el grupo de trabajo de graduación!!');
                return redirect()->route('grupo.create');
            }else{
                Session::flash('message-error','Ocurrió un problema al momento de enviar el grupo de trabajo de graduación!');
                return redirect()->route('grupo.create');
            }
        } catch (\Exception $e) {
           Session::flash('message-error','Ocurrió un problema al momento de enviar el grupo de trabajo de graduación!');
            return redirect()->route('grupo.create');
        }
       
    }

     public function aprobarGrupo(Request $request){
        try {
            $grupo=new pdg_gru_grupoModel();
            $respuesta=$grupo->aprobarGrupo($request['idGrupo']); 
            if ($respuesta[0]->resultado == '0'){
                Session::flash('message','Se aprobó el grupo de trabajo de graduación ');
                return redirect()->route('grupo.index');
            }else{
                Session::flash('tipo','error');
                Session::flash('message','Ocurrió un problema al momento de aprobar el grupo de trabajo de graduación!');
                return redirect()->route('grupo.index');
            }
            
        } catch (\Exception $e) {
           Session::flash('tipo','error');
           Session::flash('message','Ocurrió un problema al momento de aprobar el grupo de trabajo de graduación!');
            return redirect()->route('grupo.index');
        }
       
    }
/*EJRG begin*/
    public function verGrupo(Request $request){
        $userLogin=Auth::user();
        if ($userLogin->can(['grupo.index'])) {

            $id = $request ->input('idGrupo');

            $relaciones = pdg_gru_grupoModel::find($id)->relaciones_gru_est;

            return view('TrabajoGraduacion.ConformarGrupo.view',compact(['relaciones']));
        }else{

            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return  redirect('/');
        }
    }
    public function deleteRelacion(Request $request){
        $url = $request ->fullUrl();
        $var = strpos($url,'?');
        if ($var !== FALSE){
            try {
                $id = substr($url, $var + 1, strlen($url));
                $relacion = pdg_gru_est_grupo_estudianteModel::find($id);

                $clon = $relacion->getAttributes();

                $relacion -> delete(); //Eliminar la relación del Estudiante con Grupo
                $grupo  = pdg_gru_grupoModel::find($clon['id_pdg_gru']);
                $relaciones = $grupo->relaciones_gru_est;
                if ($relaciones->isEmpty()) {
                    $grupo -> delete();//Eliminar grupo si no existen relaciones Estudiante-Grupo
                    Session::flash('message-warning', 'Grupo eliminado por falta de integrantes');
                    return redirect()->route('grupo.index');
                }else{
                    if ($clon['eslider_pdg_gru_est']>0){//Verificar si el alumno eliminado era líder
                        $nuevoLider = $relaciones->firstWhere('eslider_pdg_gru_est','=',0);
                        $nuevoLider->eslider_pdg_gru_est = 1;//Asignar nuevo líder
                        $nuevoLider->save(['timestamps' => false]);
                    }
                    Session::flash('message-warning','Estudiante eliminado del grupo');
                    //return Redirect::to('TrabajoGraduacion\ConformarGrupo.view',compact(['relaciones']));
                    return view('TrabajoGraduacion.ConformarGrupo.view',compact(['relaciones']));
                }
            } catch (\Exception $e) {
                Session::flash('message-error','Ocurrió un problema al momento de borrar el alumno!');
                return redirect()->route('grupo.index');
            }
        }else{
            return redirect()->route('grupo.index');
        }
        return redirect()->route('grupo.index');
    }
    public function estSinGrupo($anio){
        return gen_EstudianteModel::getEstudiantesSinGrupo($anio);
    }
    public function addAlumno(Request $request){
        $errorCode = -1;
        $errorMessage = "No se procesaron los datos";
        $id_gen_est = $request['id'];
        $id_pdg_gru = $request['grupo'];
        if($id_gen_est != null && $id_pdg_gru != null){
            try{
                $grupo  = pdg_gru_grupoModel::find($id_pdg_gru);
                $estudiante = gen_EstudianteModel::find($id_gen_est);
                if($grupo!=null&&$estudiante!=null){
                    $relacion = new pdg_gru_est_grupo_estudianteModel();
                    $relacion->id_pdg_gru = $id_pdg_gru;
                    $relacion->id_gen_est = $id_gen_est;
                    $relacion->id_cat_sta = '6';
                    $relacion->eslider_pdg_gru_est = '0';
                    $relacion->save(['timestamps' => false]);
                    $errorCode = 0;
                    $errorMessage = "Grupo modificado satisfactoriamente!";
                }
            }catch (\Exception $e){
                $errorCode = 1;
                $errorMessage = "Su solicitud no pudo ser procesada";
                //$errorMessage = $e->getMessage();
            }
        }
        return response()->json(['errorCode'=>$errorCode,'errorMessage'=>$errorMessage]);
    }
/*EJRG end*/
    public function editRolGrupo($idGrupo){
        $grupoNombre = pdg_gru_grupoModel::find($idGrupo);
        if (empty($grupoNombre->id_pdg_gru)) {
            return redirect('/');
        }
        $grupo= new pdg_gru_grupoModel();
        $resultado = $grupo->getDetalleGrupo($idGrupo);
        $nombre = $grupoNombre->numero_pdg_gru;
        
        //return var_dump($resultado);
        return view('TrabajoGraduacion.ConformarGrupo.editMiembro',compact('resultado','nombre'));

    }

    public function updateRolMiembro(Request $request){
        try {
            $idGrupo = "";
            foreach ($request['carnets'] as $carnet) { 
                $alumno = gen_EstudianteModel::where('carnet_gen_est', '=',$carnet)->first();
                $estudiante  =pdg_gru_est_grupo_estudianteModel::where('id_gen_est', '=',$alumno->id_gen_est)->first();
                $idGrupo = $estudiante->id_pdg_gru;
                $objEstudiante = pdg_gru_est_grupo_estudianteModel::find($estudiante->id_pdg_gru_est);
                $objEstudiante->eslider_pdg_gru_est = $request[$carnet];
                $objEstudiante->save();
            }
            $grupo = pdg_gru_grupoModel::find($idGrupo);
            Session::flash('message','Se actualizaron los roles de los integrantes del Grupo '.$grupo->numero_pdg_gru);
            return redirect('listadoGrupos');
        } catch (\Exception $e) {
            Session::flash('message-error','Ocurrió un error al actualizar los roles de los miembros del grupo de trabajo de graduación, por favor intente mas tarde');
            return redirect('listadoGrupos');
        }
        
    }

}
