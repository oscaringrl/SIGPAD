<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use \App\cat_pensumModel;
use \App\cat_carreraModel;
use \App\cat_materiaModel;

class cat_materiaController extends Controller
{
      public function __construct()
      {
          $this->middleware('auth');
      }

      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
          $userLogin = Auth::user();
          if ($userLogin->can(['catMaterias.index'])) {
              $catMateria = cat_materiaModel::all();
              $pensums = cat_pensumModel::all();
              $carreras = cat_carreraModel::all();
              return view('catMaterias.index', compact('catMateria','pensums','carreras'));
          } else {
              Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
              return view('template');
          }
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create(){

        $userLogin=Auth::user();
        if ($userLogin->can(['catMaterias.create'])) {
          $pensums = cat_pensumModel::pluck('anio_pensum','id_pensum');
          $carreras = cat_carreraModel::pluck('nombre_carrera','id_carrera');
          return view('catMaterias.create',compact('pensums','carreras'));
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
              'codigo_materia' => 'required|max:45',
              'nombre_materia' => 'required|max:100',
              'es_electiva' => 'required',
              'id_pensum' => 'required',
              'id_carrera' => 'required'
          ],
              [
                'codigo_materia.required' => 'Debe ingresar el codigo de la materia',
                'nombre_materia.required' => 'Debe ingresar el nombre de la materia',
                'es_electiva.required' => 'Seleccione si la materia es electiva',
                'id_pensum.required' => 'Debe seleccionar un pensum',
                'id_carrera.required' => 'Debe seleccionar una carrera'
              ]
          );

          cat_materiaModel::create
          ([
              'codigo_materia'                => $request["codigo_materia"],
              'nombre_materia'                => $request["nombre_materia"],
              'es_electiva'                   => $request["es_electiva"],
              'id_pensum'                     => $request["id_pensum"],
              'id_carrera'                    => $request["id_carrera"]
          ]);

          Return redirect('catMaterias')->with('message','Materia Registrada correctamente!') ;
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
          if ($userLogin->can(['catMaterias.edit'])) {
              $pensums = cat_pensumModel::pluck('anio_pensum','id_pensum');
              $carreras = cat_carreraModel::pluck('nombre_carrera','id_carrera');
              $catMateria=cat_materiaModel::find($id);

              return view('catMaterias.edit',compact(['pensums','carreras','catMateria']));
          }else{
              Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
              return  view('template');
          }
      }

      public function update(Request $request, $id)
      {
          $catMateria=cat_materiaModel::find($id);

          $catMateria->fill($request->all());
          $catMateria->save();
          Session::flash('message','Materia Modificada correctamente!');
          return Redirect::to('catMaterias');
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
          if ($userLogin->can(['catMaterias.destroy']))
              {
              try {
                  cat_materiaModel::destroy($id);
              } catch (\PDOException $e)
              {
                  Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
                  return Redirect::to('catMaterias');
              }
                  Session::flash('message','Materia Eliminada Correctamente!');
                  return Redirect::to('catMaterias');

          }else{
              Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
              return  view('template');
          }
      }
}
