<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use \App\dcn_dip_diplomadosModel;
use \App\cat_ins_institucionModel;
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
      $institucion = cat_ins_institucionModel::pluck('nombre_ins','id');//se cambiara el id
      return view('PerfilDocente.Catalogos.Diplomados.create',compact('instituciones'));
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
              'descripcion_diplomado' => 'required',
              'fecha_inicio_diplomado' => 'required',
              'fecha_fin_diplomado' => 'required',
              'id_ins' => 'required'


          ],
          [
            'nombre_diplomado.required' => ' Se require un nombre de diplomado',
            'descripcion_diplomado.required' => 'Se requiere una descrpcion del diplomado',
            'fecha_inicio_diplomado.required' => 'Se require una fecha de inicio',
            'fecha_fin_diplomado.required' => 'Se requiere una fecha de finalización',
            'id_ins.required' => 'Debe seleccionar una institucion'


          ]
      );
      $userLogin = Auth::user();
      $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
      $idDocente = $docente->id_pdg_dcn;
      $lastId = dcn_dip_diplomadosModel::create
                  ([
                      'nombre_diplomado'                => $request["nombre_diplomado"],
                      'descripcion_diplomado'       => $request["descripcion_diplomado"],
                      'fecha_inicio_diplomado'           => $request["fecha_inicio_diplomado"],
                      'fecha_fin_diplomado'                    => $request["fecha_fin_diplomado"],
                      'id_ins'                        => $request["id"],
                      'id_dcn'                        => $idDocente

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
      $institucion = cat_ins_institucionModel::pluck('nombre_ins','id');
      $diplomado = dcn_dip_diplomadosModel::find($id);
      $userLogin = Auth::user();
      $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
      $idDocente = $docente->id_pdg_dcn;
      if (empty($diplomado->id)){//el id de diplomado se debe cambiar
         return Redirect::to('/');
      }else if ($idDocente != $diplomado->id_dcn) {
         return Redirect::to('/');
      }else{
          return view('PerfilDocente.Catalogos.Diplomados.edit',compact('institucion','diplomado'));
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
            'descripcion_diplomado' => 'required',
            'fecha_inicio_diplomado' => 'required',
            'fecha_fin_diplomado' => 'required',
            'id_ins' => 'required'


        ],
        [
          'nombre_diplomado.required' => ' Se require un nombre de diplomado',
          'descripcion_diplomado.required' => 'Se requiere una descrpcion del diplomado',
          'fecha_inicio_diplomado.required' => 'Se require una fecha de inicio',
          'fecha_fin_diplomado.required' => 'Se requiere una fecha de finalización',
          'id_ins.required' => 'Debe seleccionar una institucion'


        ]
      );
      $userLogin = Auth::user();
      $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
      $idDocente = $docente->id_pdg_dcn;
      $diplomado = dcn_dip_diplomadosModel::find($id);
      $diplomado ->nombre_diplomado = $request["nombre_diplomado"];
      $diplomado ->descripcion_diplomado = $request["descripcion_diplomado"];
      $diplomado ->fecha_inicio_diplomado = $request["fecha_inicio_diplomado"];
      $diplomado ->fecha_fin_diplomado = $request["fecha_fin_diplomado"];
      $diplomado ->id_ins = $request["id_ins"];
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
      dcn_cer_certificacionesModel::destroy($id);
      Session::flash('message','Registro de diplomado  Eliminado Correctamente!');
      Session::flash('apartado','7');
      return Redirect::to('DashboardPerfilDocente');
  }


}
