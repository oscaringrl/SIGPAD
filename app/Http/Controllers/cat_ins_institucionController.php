<?php

namespace App\Http\Controllers;

use App\cat_ins_institucionModel;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;

class cat_ins_institucionController extends Controller
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
      $userLogin=Auth::user();
      if ($userLogin->can(['catInstitucion.index'])) {
          $catInstitucion =cat_ins_institucionModel::all();
          return view('catInstitucion.index',compact('catInstitucion'));
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
      if ($userLogin->can(['catInstitucion.create'])) {
          return view('catInstitucion.create');
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
          'nombre_ins' => 'required|max:256'
      ],
          [
              'nombre_ins.required' => 'El nombre de la institucion es necesario',
              'nombre_ins.max' => 'El nombre de la institucion debe contener como maximo 256 caracteres'
          ]

      );



      cat_ins_institucionModel::create
      ([
          'nombre_ins'       	 => $request['nombre_ins']

      ]);

      Return redirect('catInstitucion')->with('message','Institucion Registrada correctamente!') ;

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
      if ($userLogin->can(['catInstitucion.edit'])) {
          $catInstitucion= cat_ins_institucionModel::find($id);

          return view('catInstitucion.edit',compact(['catInstitucion']));
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
      $catInstitucion=cat_ins_institucionModel::find($id);

      $catInstitucion->fill($request->all());
      $catInstitucion->save();
      // Session::flash('message','Tipo Documento Modificado correctamente!');
      return Redirect::to('catInstitucion');

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
  if ($userLogin->can(['catInstitucion.destroy']))
  {
          try {
              cat_ins_institucionModel::destroy($id);

          } catch (\PDOException $e)
          {
              Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
              return Redirect::to('catInstitucion');
          }
      Session::flash('message','Institucion Eliminada Correctamente!');
      return Redirect::to('catInstitucion');

  }else{
          Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
          return  view('template');
      }

  }
}
