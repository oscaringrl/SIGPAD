<?php

namespace App\Http\Controllers;

use App\cat_mod_modalidadModel;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;

class cat_mod_modalidadController extends Controller
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
        if ($userLogin->can(['catModalidad.index'])) {
            $catModalidad =cat_mod_modalidadModel::all();
            return view('catModalidad.index',compact('catModalidad'));
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
        if ($userLogin->can(['catModalidad.create'])) {
            return view('catModalidad.create');
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
            'nombre_modalidad' => 'required|max:256'
        ],
            [
                'nombre_modalidad.required' => 'La descripción es necesaria',
                'nombre_modalidad.max' => 'La descripción debe contener como maximo 256 caracteres'
            ]

        );



        cat_mod_modalidadModel::create
        ([
            'nombre_modalidad'       	 => $request['nombre_modalidad']

        ]);

        Return redirect('catModalidad')->with('message','Modalidad Registrada correctamente!') ;

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
        if ($userLogin->can(['catModalidad.edit'])) {
            $catModalidad= cat_mod_modalidadModel::find($id);

            return view('catModalidad.edit',compact(['catModalidad']));
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
        $catModalidad=cat_mod_modalidadModel::find($id);

        $catModalidad->fill($request->all());
        $catModalidad->save();
        // Session::flash('message','Tipo Documento Modificado correctamente!');
        return Redirect::to('catModalidad');

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
    if ($userLogin->can(['catModalidad.destroy']))
    {
            try {
                cat_mod_modalidadModel::destroy($id);

            } catch (\PDOException $e)
            {
                Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
                return Redirect::to('catModalidad');
            }
        Session::flash('message','Modalidad Eliminada Correctamente!');
        return Redirect::to('catModalidad');

    }else{
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return  view('template');
        }

    }
}
