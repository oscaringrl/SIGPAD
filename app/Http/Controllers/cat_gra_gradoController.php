<?php

namespace App\Http\Controllers;

use App\cat_gra_gradoModel;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;

class cat_gra_gradoController extends Controller
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
      if ($userLogin->can(['catGrado.index'])) {
          $catGrado =cat_gra_gradoModel::all();
          return view('catGrado.index',compact('catGrado'));
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
      if ($userLogin->can(['catGrado.create'])) {
          return view('catGrado.create');
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
          'nombre_g' => 'required|max:256',
          'descripcion_g' => 'required|max:256'
      ],
          [
              'nombre_g.required' => 'La descripción es necesaria',
              'nombre_g.max' => 'La descripción debe contener como maximo 256 caracteres',
              'descripcion_g.required' => 'La descripción es necesaria',
              'descripcion_g.max' => 'La descripción debe contener como maximo 256 caracteres'
          ]

      );



      cat_gra_gradoModel::create
      ([
          'nombre_g'       	 => $request['nombre_g'],
          'descripcion_g'    => $request['descripcion_g']

      ]);

      Return redirect('catGrado')->with('message','Grado Registrado correctamente!') ;

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
      if ($userLogin->can(['catGrado.edit'])) {
          $catGrado= cat_gra_gradoModel::find($id);

          return view('catGrado.edit',compact(['catGrado']));
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
      $catGrado=cat_gra_gradoModel::find($id);

      $catGrado->fill($request->all());
      $catGrado->save();
      // Session::flash('message','Tipo Documento Modificado correctamente!');
      return Redirect::to('catGrado');

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
  if ($userLogin->can(['catGrado.destroy']))
  {
          try {
              cat_gra_gradoModel::destroy($id);

          } catch (\PDOException $e)
          {
              Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
              return Redirect::to('catGrado');
          }
      Session::flash('message','Grado Eliminado Correctamente!');
      return Redirect::to('catGrado');

  }else{
          Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
          return  view('template');
      }

  }
}
