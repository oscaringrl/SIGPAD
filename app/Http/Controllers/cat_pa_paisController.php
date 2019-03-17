<?php

namespace App\Http\Controllers;
use App\cat_pa_paisModel;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class cat_pa_paisController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

  public function index()
  {
      $userLogin=Auth::user();
      if ($userLogin->can(['catPais.index'])) {
          $catPais = cat_pa_paisModel::all();
          return view('catPais.index',compact('catPais'));

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
      if ($userLogin->can(['catPais.create'])) {
          return view('catPais.create');
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
          'nombre_pais' => 'required|max:45'
      ],
          [
              'nombre_pais.required' => 'El pais es requerido',
              'nombre_pais.max' => 'El pais debe contener como maximo 45 caracteres'
          ]
      );

      cat_pa_paisModel::create
      ([
          'nombre_pais'=> $request['nombre_pais']
      ]);

      Return redirect('catPais')->with('message','Pais Registrado correctamente!') ;
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
      if ($userLogin->can(['catPais.edit'])) {
          $catPais=cat_pa_paisModel::find($id);

          return view('catPais.edit',compact(['catPais']));
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
      $catPais=cat_pa_paisModel::find($id);

      $catPais->fill($request->all());
      $catPais->save();
      Session::flash('message','Pais Modificado correctamente!');
      return Redirect::to('catPais');
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
      if ($userLogin->can(['catPais.destroy']))
          {
          try {
              cat_pa_paisModel::destroy($id);
          } catch (\PDOException $e)
          {
              Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
              return Redirect::to('catPais');
          }
              Session::flash('message','Pais Eliminado Correctamente!');
              return Redirect::to('catPais');

      }else{
          Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
          return  view('template');
      }
  }
}
