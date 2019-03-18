<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use \App\dcn_postg_postgradoModel;
use \App\cat_ins_institucionModel;
use \App\cat_pa_paisModel;
use \App\pdg_dcn_docenteModel;

class PostgradoController extends Controller
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
          return view('PerfilDocente.Catalogos.Postgrados.create',compact('instituciones','paises'));
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
                  'abreviatura' => 'required',
                  'nombre_p_grado' => 'required',
                  'descripcion_p_grado' => 'required',
                  'fecha_inicio' => 'required',
                  'fecha_fin' => 'required|after:fecha_inicio',
                  'id_cat_inst' => 'required',
                  'id_cat_pa' => 'required'
              ],
              [
                  'abreviatura.required' => 'Debe ingresar la abreviatura del postgrado',
                  'nombre_p_grado.required' => 'Debe ingresar un nombre del postgrado',
                  'descripcion_p_grado' => 'Ingrese una breve descripcion del postgrado',
                  'fecha_inicio.required' => 'Ingrese la fecha de inicio en que realizo el postgrado',
                  'fecha_fin.required' => 'Ingrese la fecha de finalizacion del postgrado',
                  'fecha_fin.after' => 'La fecha de finalizacion del postgrado debe ser mayor a la fecha inicio',
                  'id_cat_inst.required' => 'Debe seleccionar una institucion',
                  'id_cat_pa.required' => 'Debe seleccionar un pais'
              ]
          );
          $userLogin = Auth::user();
          $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
          $idDocente = $docente->id_pdg_dcn;
          $lastId = dcn_postg_postgradoModel::create
                      ([
                          'abreviatura'                   => $request["abreviatura"],
                          'nombre_p_grado'                => $request["nombre_p_grado"],
                          'descripcion_p_grado'           => $request["descripcion_p_grado"],
                          'fecha_inicio'                  => $request["fecha_inicio"],
                          'fecha_fin'                     => $request["fecha_fin"],
                          'id_cat_inst'                   => $request["id_cat_inst"],
                          'id_cat_pa'                     => $request["id_cat_pa"],
                          'id_dcn'                        => $idDocente
                      ]);
          Session::flash('apartado','6');
          Session::flash('message','Registro de postgrado realizado correctamente!');
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
          $postgrado = dcn_postg_postgradoModel::find($id);
          $userLogin = Auth::user();
          $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
          $idDocente = $docente->id_pdg_dcn;
          if (empty($postgrado->id_dcn_post)){
             return Redirect::to('/');
          }else if ($idDocente != $postgrado->id_dcn) {
             return Redirect::to('/');
          }else{
              return view('PerfilDocente.Catalogos.Postgrados.edit',compact('instituciones','paises','postgrado'));
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
               'abreviatura' => 'required',
               'nombre_p_grado' => 'required',
               'descripcion_p_grado' => 'required',
               'fecha_inicio' => 'required',
               'fecha_fin' => 'required',
               'id_cat_inst' => 'required',
               'id_cat_pa' => 'required'
           ],
           [
               'abreviatura.required' => 'Debe ingresar la abreviatura del postgrado',
               'nombre_p_grado.required' => 'Debe ingresar un nombre del postgrado',
               'descripcion_p_grado' => 'Ingrese una breve descripcion del postgrado',
               'fecha_inicio' => 'Ingrese la fecha de inicio en que realizo el postgrado',
               'fecha_fin' => 'Ingrese la fecha de finalizacion del postgrado',
               'id_cat_inst.required' => 'Debe seleccionar una institucion',
               'id_cat_pa.required' => 'Debe seleccionar un pais'
           ]
       );
          $userLogin = Auth::user();
          $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
          $idDocente = $docente->id_pdg_dcn;
          $postgrado = dcn_postg_postgradoModel::find($id);
          $postgrado ->abreviatura = $request["abreviatura"];
          $postgrado ->nombre_p_grado = $request["nombre_p_grado"];
          $postgrado ->descripcion_p_grado = $request["descripcion_p_grado"];
          $postgrado ->fecha_inicio = $request["fecha_inicio"];
          $postgrado ->fecha_fin = $request["fecha_fin"];
          $postgrado ->id_cat_inst = $request["id_cat_inst"];
          $postgrado ->id_cat_pa = $request["id_cat_pa"];
          $postgrado->save();
          Session::flash('apartado','6');
          Session::flash('message','Registro de postgrados actulizado correctamente!');
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
          dcn_postg_postgradoModel::destroy($id);
          Session::flash('message','Registro de postgrados  Eliminado Correctamente!');
          Session::flash('apartado','6');
          return Redirect::to('DashboardPerfilDocente');
      }
}
