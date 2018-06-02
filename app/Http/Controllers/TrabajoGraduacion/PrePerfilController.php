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
class PrePerfilController extends Controller
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
        if ($userLogin->can(['prePerfil.index'])) {
        	if (Auth::user()->isRole('administrator_tdg')){
        		//VERIFICAMOS EL ROL
        		$prePerfiles =pdg_ppe_pre_perfilModel::all();
		       	return view('TrabajoGraduacion.PrePerfil.index',compact('prePerfiles'));
        	}else{
        		$grupo=self::verificarGrupo($userLogin->user)->getData();
		        $estudiantes=json_decode($grupo->msg->estudiantes);
		 
		        if ($grupo->errorCode == '0'){
		        	$idGrupo = $estudiantes[0]->idGrupo;
		        	$miGrupo = pdg_gru_grupoModel::find($idGrupo);
		        	if ($miGrupo->id_cat_sta == 3 ) {//APROBADO
		        		$numero=$miGrupo->numero_pdg_gru;
		        		$prePerfiles =pdg_ppe_pre_perfilModel::where('id_pdg_gru', '=',$idGrupo)->get();
		        		return view('TrabajoGraduacion.PrePerfil.index',compact('prePerfiles','numero'));
		        	}else{
		        		//EL GRUPO AUN NO HA SIDO APROBADO
		        	Session::flash('message-error', 'Tu grupo de trabajo de graduación aún no ha sido aprobado');
		            return  view('template');
		        	}
		        }else{
		        	//NO HA CONFORMADO UN GRUPO
		        	Session::flash('message-error', 'Para poder acceder a esta opción, primero debes conformar un grupo de trabajo de graduación');
		            return  view('template');
		        }
        	}
	     
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
    public function create()
    {    $userLogin=Auth::user();
    	 if ($userLogin->can(['prePerfil.create'])) {
	        $grupo=self::verificarGrupo($userLogin->user)->getData();
	        $estudiantes=json_decode($grupo->msg->estudiantes);
	        if ($grupo->errorCode == '0'){
	        	$idGrupo = $estudiantes[0]->idGrupo;
	        	$miGrupo = pdg_gru_grupoModel::find($idGrupo);
	        	if ($miGrupo->id_cat_sta == 3 ) {//APROBADO
	        		$tiposTrabajos =  cat_tpo_tra_gra_tipo_trabajo_graduacionModel::pluck('nombre_cat_tpo_tra_gra', 'id_Cat_tpo_tra_gra')->toArray();
	        		return view('TrabajoGraduacion.PrePerfil.create',compact('tiposTrabajos'));
	        	}else{
	        		//EL GRUPO AUN NO HA SIDO APROBADO
	        	Session::flash('message-error', 'Tu grupo de trabajo de graduación aún no ha sido aprobado');
	            return  view('template');
	        	}
	        }else{
	        	//NO HA CONFORMADO UN GRUPO
	        	Session::flash('message-error', 'Para poder acceder a esta opción, primero debes conformar un grupo de trabajo de graduación');
	            return  view('template');
	        }
        }else{
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return  view('template');
        }   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$validatedData = $request->validate([
                'tema' => 'required|max:80',
                'documento' => 'required'
         ]);
  	   $userLogin=Auth::user();
  	   $grupo=self::verificarGrupo($userLogin->user)->getData();
	        $estudiantes=json_decode($grupo->msg->estudiantes);
	        if ($grupo->errorCode == '0'){
	        	$idGrupo = $estudiantes[0]->idGrupo;
	        }
       //obtenemos el campo file definido en el formulario
      	$file = $request->file('documento');
       //obtenemos el nombre del archivo
      	$nombre = "Grupo1"."_2018_".date('hms').$file->getClientOriginalName();
       //indicamos que queremos guardar un nuevo archivo en el disco local
        Storage::disk('prePerfiles')->put($nombre, File::get($file));
        $fecha=date('Y-m-d H:m:s');
            $path= public_path()."\Uploads\PrePerfil\ ";

           $lastId = pdg_ppe_pre_perfilModel::create
            ([
                'tema_pdg_ppe'   				 => $request['tema'],
                'nombre_archivo_pdg_ppe'       	 =>  $nombre,
                'ubicacion_pdg_ppe'  		 	 => trim($path).$nombre,
                'fecha_creacion_pdg_ppe'       	 => $fecha,
                'id_pdg_gru'					 => $idGrupo,
                'id_cat_sta'					 => 7,
                'id_cat_tpo_tra_gra'			 => $request['tipoTrabajo'],
                'id_gen_usuario'                 => $userLogin->id
            ]); 
       Return redirect('/prePerfil/create')->with('message','Pre-Perfil Registrado correctamente!') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

           $userLogin=Auth::user();
            if ($userLogin->can(['usuario.edit'])) {
            $usuario=gen_UsuarioModel::find($id);
            $user=User::find($id);
            $roles=$user->getRoles();
            $rolesBd = Role::all();
            $select = "<select name='rol[]' multiple ='multiple' class='form-control' id='roles'>"; 
            foreach ($rolesBd as $rolBd ) {
               $flag=0;
               foreach ($roles as $rol ) {
                   if ($rolBd->slug == $rol ) {
                       $flag=1;
                   }
               }
               if ($flag == 1) {
                   $select .= "<option value='".$rolBd->id."' selected>".$rolBd->name."</option>"; 
               }else{
                    $select .= "<option value='".$rolBd->id."'>".$rolBd->name."</option>"; 
               }
            }
            $select .= "</select>";
           return view('usuario.edit',compact(['usuario','select','roles']));
        }else{
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return  view('template');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validatedData = $request->validate([
                'name' => 'required|max:50',
                'user' => 'required|max:30',
                'email' => 'required|max:250|email',
                'rol' => 'required'
        ]);
        $usuario=gen_UsuarioModel::find($id);
        $user=User::find($id);
        $usuario->fill($request->all()); 
        $usuario->save();
        $user->syncRoles($request['rol']);
        Session::flash('message','Usuario Modificado correctamente!');
        return Redirect::to('/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userLogin=Auth::user();
        if ($userLogin->can(['usuario.destroy'])) {
            $user=User::find($id);
            $user->revokeAllRoles();
            gen_UsuarioModel::destroy($id);
            Session::flash('message','Usuario Eliminado Correctamente!');
            return Redirect::to('/usuario');
        }else{
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return  view('template');
        }
        
    } 

    public function verificarGrupo($carnet) {
	    $estudiante = new gen_EstudianteModel();
	    $respuesta = $estudiante->getGrupoCarnet($carnet);
	    return $respuesta; 
	       
    }
    function downloadPrePerfil(Request $request){
    	$path = $request['archivo'];
    	return response()->download($path);
    	//return $path;
    }
}