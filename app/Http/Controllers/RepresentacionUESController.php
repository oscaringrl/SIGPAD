<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use \App\dcn_rep_ues_representacion_uesModel;
use \App\cat_ins_institucionModel;
use \App\cat_pa_paisModel;
use \App\cat_tip_rep_tipo_representacionModel;
use \App\pdg_dcn_docenteModel;

class RepresentacionUESController extends Controller
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
          $paises = cat_pa_paisModel::pluck('nombre_pais','id_cat_pa');
          $tipos = cat_tip_rep_tipo_representacionModel::pluck('nombre_tip_repre', 'id_cat_tip_rep');
          return view('PerfilDocente.Catalogos.RepresentacionUES.create',compact('instituciones','paises','tipos'));
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
                  'evento_re_ues' => 'required',
                  'descripcion_re_ues' => 'required',
                  'mision_oficial' => 'required',
                  'fecha_inicio_rep' => 'required',
                  'fecha_fin_rep' => 'required',
                  'id_cat_inst' => 'required',
                  'id_cat_pa' => 'required',
                  'id_cat_tip_rep' => 'required'
              ],
              [
                  'evento_re_ues.required' => 'Debe ingresar el evento a representar',
                  'descripcion_re_ues' => 'Debe ingresar una breve descripcion de representacion',
                  'mision_oficial' => 'Ingrese mision oficial de representacion',
                  'fecha_inicio_rep' => 'Ingrese la fecha de inicio de la representacion',
                  'fecha_fin_rep' => 'Ingrese la fecha de finalizacion de la representacion',
                  'id_cat_inst.required' => 'Debe seleccionar una institucion',
                  'id_cat_pa.required' => 'Debe seleccionar un pais',
                  'id_cat_tip_rep.required' => 'Debe seleccionar un tipo'
              ]
          );
          $userLogin = Auth::user();
          $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
          $idDocente = $docente->id_pdg_dcn;
          $lastId = dcn_rep_ues_representacion_uesModel::create
                      ([
                          'evento_re_ues'                     => $request["evento_re_ues"],
                          'descripcion_re_ues'                => $request["descripcion_re_ues"],
                          'mision_oficial'                    => $request["mision_oficial"],
                          'fecha_inicio_rep'                  => $request["fecha_inicio_rep"],
                          'fecha_fin_rep'                     => $request["fecha_fin_rep"],
                          'id_cat_inst'                       => $request["id_cat_inst"],
                          'id_cat_pa'                         => $request["id_cat_pa"],
                          'id_cat_tip_rep'                    => $request["id_cat_tip_rep"],
                          'id_dcn'                            => $idDocente
                      ]);
          Session::flash('apartado','9');
          Session::flash('message','Registro de representacion realizado correctamente!');
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
          $paises = cat_pa_paisModel::pluck('nombre_pais','id_cat_pa');
          $tipos = cat_tip_rep_tipo_representacionModel::pluck('nombre_tip_repre', 'id_cat_tip_rep');
          $representacion = dcn_rep_ues_representacion_uesModel::find($id);
          $userLogin = Auth::user();
          $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
          $idDocente = $docente->id_pdg_dcn;
          if (empty($representacion->id_dcn_rep)){
             return Redirect::to('/');
          }else if ($idDocente != $representacion->id_dcn) {
             return Redirect::to('/');
          }else{
              return view('PerfilDocente.Catalogos.RepresentacionUES.edit',compact('instituciones','paises','representacion','tipos'));
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
              'evento_re_ues' => 'required',
              'descripcion_re_ues' => 'required',
              'mision_oficial' => 'required',
              'fecha_inicio_rep' => 'required',
              'fecha_fin_rep' => 'required',
              'id_cat_inst' => 'required',
              'id_cat_pa' => 'required',
              'id_cat_tip_rep' => 'required'
          ],
          [
              'evento_re_ues.required' => 'Debe ingresar el evento a representar',
              'descripcion_re_ues' => 'Debe ingresar una breve descripcion de representacion',
              'mision_oficial' => 'Ingrese mision oficial de representacion',
              'fecha_inicio_rep' => 'Ingrese la fecha de inicio de la representacion',
              'fecha_fin_rep' => 'Ingrese la fecha de finalizacion de la representacion',
              'id_cat_inst.required' => 'Debe seleccionar una institucion',
              'id_cat_pa.required' => 'Debe seleccionar un pais',
              'id_cat_tip_rep.required' => 'Debe seleccionar un tipo'
          ]
      );
          $userLogin = Auth::user();
          $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
          $idDocente = $docente->id_pdg_dcn;
          $representacion = dcn_rep_ues_representacion_uesModel::find($id);
          $representacion ->evento_re_ues = $request["evento_re_ues"];
          $representacion ->descripcion_re_ues = $request["descripcion_re_ues"];
          $representacion ->mision_oficial = $request["mision_oficial"];
          $representacion ->fecha_inicio_rep = $request["fecha_inicio_rep"];
          $representacion ->fecha_fin_rep = $request["fecha_fin_rep"];
          $representacion ->id_cat_inst = $request["id_cat_inst"];
          $representacion ->id_cat_pa = $request["id_cat_pa"];
          $representacion ->id_cat_tip_rep = $request["id_cat_tip_rep"];
          $representacion->save();
          Session::flash('apartado','9');
          Session::flash('message','Registro de representacion actulizado correctamente!');
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
          dcn_rep_ues_representacion_uesModel::destroy($id);
          Session::flash('message','Registro de representacion Eliminado Correctamente!');
          Session::flash('apartado','9');
          return Redirect::to('DashboardPerfilDocente');
      }

}
