<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cat_tip_part_inv_tipo_participacion_investigacionModel;
use Session;
use Redirect;
use Illuminate\Support\Facades\Auth;

class cat_tip_part_inv_tipo_participacion_investigacionController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $userLogin=Auth::user();
        if ($userLogin->can(['catTipoParticipacionInv.index'])) {
            $catTipoParticipacionInv = cat_tip_part_inv_tipo_participacion_investigacionModel::all();
            return view('catTipoParticipacionInv.index',compact('catTipoParticipacionInv'));

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
        if ($userLogin->can(['catTipoParticipacionInv.create'])) {
            return view('catTipoParticipacionInv.create');
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
            'nombre_tip_part' => 'required|max:128'
        ],
            [
                'nombre_tip_part.required' => 'El tipo de participación en investigaciones es requerida',
                'nombre_tip_part.max' => 'EL tipo de participación en investigaciones debe contener como maximo 128 caracteres'
            ]
        );

        cat_tip_part_inv_tipo_participacion_investigacionModel::create
        ([
            'nombre_tip_part'=> $request['nombre_tip_part']
        ]);

        Return redirect('catTipoParticipacionInv')->with('message','Tipo de Participación Registrada correctamente!') ;
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
        if ($userLogin->can(['catTipoParticipacionInv.edit'])) {
            $catTipoParticipacionInv=cat_tip_part_inv_tipo_participacion_investigacionModel::find($id);

            return view('catTipoParticipacionInv.edit',compact(['catTipoParticipacionInv']));
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
        $catTipo=cat_tip_part_inv_tipo_participacion_investigacionModel::find($id);

        $catTipo->fill($request->all());
        $catTipo->save();
        Session::flash('message','Tipo de participación en investigaciones modificada correctamente!');
        return Redirect::to('catTipoParticipacionInv');
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
        if ($userLogin->can(['catTipoParticipacionInv.destroy']))
            {
            try {
                cat_tip_part_inv_tipo_participacion_investigacionModel::destroy($id);
            } catch (\PDOException $e)
            {
                Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
                return Redirect::to('$catTipoParticipacionInv');
            }
                Session::flash('message','Tipo de Participación en Investigaciones Eliminada Correctamente!');
                return Redirect::to('$catTipoParticipacionInv');

        }else{
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return  view('template');
        }
    }
}
