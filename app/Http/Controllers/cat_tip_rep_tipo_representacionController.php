<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cat_tip_rep_tipo_representacionModel;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;

class cat_tip_rep_tipo_representacionController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

  public function index()
  {
      $userLogin=Auth::user();
      if ($userLogin->can(['catTipoRepresentacion.index'])) {
          $catTipoRepresentacion = cat_tip_rep_tipo_representacionModel::all();
          return view('catTipoRepresentacion.index',compact('catTipoRepresentacion'));

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
  {
      $userLogin=Auth::user();
      if ($userLogin->can(['catTipoRepresentacion.create'])) {
          return view('catTipoRepresentacion.create');
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
          'nombre_tip_repre' => 'required|max:128'
      ],
          [
              'nombre_tip_repre.required' => 'El tipo de participación es requerida',
              'nombre_tip_repre.max' => 'El tipo de participación debe contener como maximo 128 caracteres'
          ]
      );

      cat_tip_rep_tipo_representacionModel::create
      ([
          'nombre_tip_repre'=> $request['nombre_tip_repre']
      ]);

      Return redirect('catTipoRepresentacion')->with('message','Tipo de Participación Registrada correctamente!') ;
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
  public function edit($id)
  {
      $userLogin=Auth::user();
      if ($userLogin->can(['catTipoRepresentacion.edit'])) {
          $catTipoRepresentacion=cat_tip_rep_tipo_representacionModel::find($id);

          return view('catTipoRepresentacion.edit',compact(['catTipoRepresentacion']));
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
      $catTipo=cat_tip_rep_tipo_representacionModel::find($id);

      $catTipo->fill($request->all());
      $catTipo->save();
      Session::flash('message','Tipo de Participación Modificada correctamente!');
      return Redirect::to('catTipoRepresentacion');
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
      if ($userLogin->can(['catTipoRepresentacion.destroy']))
          {
          try {
              cat_tip_rep_tipo_representacionModel::destroy($id);
          } catch (\PDOException $e)
          {
              Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
              return Redirect::to('catTipoRepresentacion');
          }
              Session::flash('message','Tipo de Participación  Eliminada Correctamente!');
              return Redirect::to('catTipoRepresentacion');

      }else{
          Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
          return  view('template');
      }
  }
}
