<?php

namespace App\Http\Controllers;

use App\cat_carreraModel;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class cat_carreraController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
   }

   public function index()
   {
       $userLogin=Auth::user();
       if ($userLogin->can(['catCarrera.index'])) {
           $catCarrera = cat_carreraModel::all();
           return view('catCarrera.index',compact('catCarrera'));
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
       if ($userLogin->can(['catCarrera.create'])) {
         $catEscuela = DB::table('escuela')->pluck("nombre_escuela", "id_escuela");
         return view('catCarrera.create', compact('catEscuela'));
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
           'codigo_carrera' => 'required|max:10',
           'nombre_carrera' => 'required|max:100'//,
           //'id_escuela' => 'required'
       ],
           [
               'codigo_carrera.required' => 'El codigo de la carrera es necesario',
               'codigo_carrera.max' => 'El codigo de la carrera debe contener como maximo 10 caracteres',
               'nombre_carrera.required' => 'El nombre de la carrera es necesario',
               'nombre_carrera.max' => 'El nombre de la carrera debe contener como maximo 100 caracteres'//,
               //'id_escuela.required' => 'Debe seleccionar una escuela, a la que pertenezca la carrera'
           ]

       );

       cat_carreraModel::create
       ([
           'codigo_carrera'       	 => $request['codigo_carrera'],
           'nombre_carrera'       	 => $request['nombre_carrera'],
           'id_escuela'              => $request['id_escuela']
        ]);

       Return redirect('catCarrera')->with('message','Carrera Registrada correctamente!') ;

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
       if ($userLogin->can(['catCarrera.edit'])) {
           $catCarrera= cat_carreraModel::find($id);
           $catEscuela = DB::table('escuela')->pluck("id_escuela", "nombre_escuela");
           return view('catCarrera.edit',compact('catCarrera','catEscuela'));
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
       $catCarrera=cat_carreraModel::find($id);

       $catCarrera->fill($request->all());
       $catCarrera->save();
       // Session::flash('message','Tipo Documento Modificado correctamente!');
       return Redirect::to('catCarrera');

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
   if ($userLogin->can(['catCarrera.destroy']))
   {
           try {
               cat_carreraModel::destroy($id);

           } catch (\PDOException $e)
           {
               Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
               return Redirect::to('catCarrera');
           }
       Session::flash('message','Carrera Eliminada Correctamente!');
       return Redirect::to('catCarrera');

   }else{
           Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
           return  view('template');
       }

   }


}
