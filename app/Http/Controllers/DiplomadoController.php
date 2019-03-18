<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use \App\dcn_dip_diplomadosModel;
use \App\cat_ins_institucionModel;
use \App\cat_mod_modalidadModel;
use \App\cat_pa_paisModel;
use \App\pdg_dcn_docenteModel;

class DiplomadoController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(){
      $instituciones = cat_ins_institucionModel::pluck('nombre_ins','id_cat_inst');
      $modalidades = cat_mod_modalidadModel::pluck('nombre_modalidad','id_cat_mod');
      $paises = cat_pa_paisModel::pluck('nombre_pais','id_cat_pa');
      return view('PerfilDocente.Catalogos.Diplomados.create',compact('instituciones','modalidades','paises'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request){
       $validatedData = $request->validate(
          [
              'nombre_diplomado' => 'required',
              'descripcion_dip' => 'required',
              'fecha_inicio_dip' => 'required',
              'fecha_fin_dip' => 'required',
              'id_cat_mod' => 'required',
              'id_cat_inst' => 'required',
              'id_cat_pa' => 'required'


          ],
          [
            'nombre_diplomado.required' => ' Se require un nombre de diplomado',
            'descripcion_dip.required' => 'Se requiere una descrpcion del diplomado',
            'fecha_inicio_dip.required' => 'Se require una fecha de inicio',
            'fecha_fin_dip' => 'Se requiere una fecha de finalización',
            'id_cat_mod.required' => 'Debe seleccionar una modalidad',
            'id_cat_inst.required' => 'Debe seleccionar una institucion',
            'id_cat_pa.required' => 'Debe seleccionar un pais'


          ]
      );
      $userLogin = Auth::user();
      $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
      $idDocente = $docente->id_pdg_dcn;
      $lastId = dcn_dip_diplomadosModel::create
                  ([
                      'nombre_diplomado'       => $request["nombre_diplomado"],
                      'descripcion_dip'        => $request["descripcion_dip"],
                      'fecha_inicio_dip'           => $request["fecha_inicio_dip"],
                      'fecha_fin_dip'              => $request["fecha_fin_dip"],
                      'id_cat_mod'             => $request["id_cat_mod"],
                      'id_cat_inst'            => $request["id_cat_inst"],
                      'id_cat_pa'              => $request["id_cat_pa"],//se debe tener el CRUD o listado de cat_pa_pais
                      'id_dcn'                 => $idDocente

                  ]);
      Session::flash('apartado','7');
      Session::flash('message','Registro de diplomado realizado correctamente!');
      return Redirect::to('DashboardPerfilDocente');
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
      $instituciones = cat_ins_institucionModel::pluck('nombre_ins','id_cat_inst');
      $modalidades = cat_mod_modalidadModel::pluck('nombre_modalidad','id_cat_mod');
      $paises = cat_pa_paisModel::pluck('nombre_pais','id_cat_pa');
      $diplomado = dcn_dip_diplomadosModel::find($id);
      $userLogin = Auth::user();
      $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
      $idDocente = $docente->id_pdg_dcn;
      if (empty($diplomado->id_dcn_dip)){
         return Redirect::to('/');
      }else if ($idDocente != $diplomado->id_dcn) {
         return Redirect::to('/');
      }else{
          return view('PerfilDocente.Catalogos.Diplomados.edit',compact('instituciones','modalidades','paises','diplomado'));
      }

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id){
      $validatedData = $request->validate(
        [
            'nombre_diplomado' => 'required',
            'descripcion_dip' => 'required',
            'fecha_inicio_dip' => 'required',
            'fecha_fin_dip' => 'required',
            'id_cat_mod' => 'required',
            'id_cat_inst' => 'required',
            'id_cat_pa' => 'required'


        ],
        [
          'nombre_diplomado.required' => ' Se require un nombre de diplomado',
          'descripcion_dip.required' => 'Se requiere una descrpcion del diplomado',
          'fecha_inicio_dip.required' => 'Se require una fecha de inicio',
          'fecha_fin_dip.required' => 'Se requiere una fecha de finalización',
          'id_cat_mod.required' => 'Debe seleccionar una modalidad',
          'id_cat_inst.required' => 'Debe seleccionar una institucion',
          'id_cat_pa.required' => 'Debe seleccionar un pais'


        ]
      );
      $userLogin = Auth::user();
      $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
      $idDocente = $docente->id_pdg_dcn;
      $pais= 1;//esto despues lo arreglamos
      $diplomado = dcn_dip_diplomadosModel::find($id);
      $diplomado ->nombre_diplomado = $request["nombre_diplomado"];
      $diplomado ->descripcion_dip = $request["descripcion_dip"];
      $diplomado ->fecha_inicio_dip = $request["fecha_inicio_dip"];
      $diplomado ->fecha_fin_dip = $request["fecha_fin_dip"];
      $diplomado ->id_cat_mod = $request["id_cat_mod"];
      $diplomado ->id_cat_inst = $request["id_cat_inst"];
      $diplomado ->id_cat_pa = $request["id_cat_pa"];
      $diplomado->save();
      Session::flash('apartado','7');
      Session::flash('message','Registro de diplomado actulizado correctamente!');
      return Redirect::to('DashboardPerfilDocente');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id){
      //
      dcn_dip_diplomadosModel::destroy($id);
      Session::flash('message','Registro de diplomado  Eliminado Correctamente!');
      Session::flash('apartado','7');
      return Redirect::to('DashboardPerfilDocente');
  }


}
