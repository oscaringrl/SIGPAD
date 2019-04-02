<?php

namespace App\Http\Controllers;

use App\cat_pensumModel;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class cat_pensumController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

  public function index()
  {
      $userLogin=Auth::user();
      if ($userLogin->can(['catPensum.index'])) {
          $catPensum = cat_pensumModel::all();
          return view('catPensum.index',compact('catPensum'));

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
      if ($userLogin->can(['catPensum.create'])) {
          return view('catPensum.create');
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
          'anio_pensum' => 'required|max:4'
      ],
          [
              'anio_pensum.required' => 'El año es requerido',
              'anio_pensum.max' => 'El año debe contener como maximo 4 caracteres'
          ]
      );

      cat_pensumModel::create
      ([
          'anio_pensum'=> $request['anio_pensum']
      ]);

      Return redirect('catPensum')->with('message','Pensum Registrado correctamente!') ;
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
      if ($userLogin->can(['catPensum.edit'])) {
          $catPensum=cat_pensumModel::find($id);

          return view('catPensum.edit',compact(['catPensum']));
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
      $catPensum=cat_pensumModel::find($id);

      $catPensum->fill($request->all());
      $catPensum->save();
      Session::flash('message','Pensum Modificado correctamente!');
      return Redirect::to('catPensum');
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
      if ($userLogin->can(['catPensum.destroy']))
          {
          try {
              cat_pensumModel::destroy($id);
          } catch (\PDOException $e)
          {
              Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
              return Redirect::to('catPensum');
          }
              Session::flash('message','Pensum Eliminado Correctamente!');
              return Redirect::to('catPensum');

      }else{
          Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
          return  view('template');
      }
  }
}
