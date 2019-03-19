<?php

namespace App\Http\Controllers;

use App\cat_idi_idiomaModel;
use App\dcn_inv_investigacionModel;
use App\pdg_dcn_docenteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;

class dcn_inv_investigacionController extends Controller
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
        /*$userLogin = Auth::user();
        if ($userLogin->can(['dcnInv.index'])) {
            $dcnInv = dcn_inv_investigacionModel::all();
            return view('dcnInv.index', compact('dcnInv'));
        } else {
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return view('template');
        }*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$userLogin = Auth::user();
        if ($userLogin->can(['dcnInv.create'])) {*/
            $catInst = DB::table('cat_ins_institucion')->pluck("nombre_ins", "id_cat_inst");
            $catPais = DB::table('cat_pa_pais')->pluck("nombre_pais", "id_cat_pa");
            $catIdioma = cat_idi_idiomaModel::pluck("nombre_cat_idi", "id_cat_idi");
            $catTipPart = DB::table('cat_tip_part_inv_tipo_participacion_investigacion')->pluck("nombre_tip_part", "id_cat_tip_part");
            return view('dcnInv.create', compact('catInst', 'catPais', 'catIdioma', 'catTipPart'));
      /*  } else {
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return view('template');
        }*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tema' => 'required|max:128',
            'fecha_inicio_inv' => 'required',
            'fecha_fin_inv' => 'required',
            'descripcion_inv' => 'required|max:512',
            'id_cat_inst' => 'required',
            'id_cat_pa' => 'required',
            'id_cat_idi' => 'required',
            'id_cat_tip_part' => 'required'
        ],
            [
                'tema.required' => 'El tema es necesario',
                'tema.max' => 'El tema debe contener como máximo 128 caracteres',
                'fecha_inicio_inv.required' => 'La fecha de inicio es necesaria',
                'fecha_fin_inv.required' => 'La fecha de fin es necesaria',
                'descripcion_inv.required' => 'La descripcion es necesaria',
                'descripcion_inv.max' => 'La descripcion debe contener como máximo 128 caracteres',
                'id_cat_inst.required' => 'La institucion es necesaria',
                'id_cat_pa.required' => 'El pais es necesario',
                'id_cat_idi.required' => 'El idioma es necesario',
                'id_cat_tip_part.required' => 'El tipo de participacion es necesario'
            ]
        );

        $userLogin = Auth::user();
        $docente = pdg_dcn_docenteModel::where("id_gen_usuario", "=", $userLogin->id)->first();
        $alumno = 0;
        $publicado = 0;
        if (isset($request["alumno"])) {
            $alumno = 1;
        }
        if (isset($request["publicado"])) {
            $publicado = 1;
        }

        dcn_inv_investigacionModel::create
        ([
            'alumno' => $alumno,
            'tema' => $request['tema'],
            'fecha_inicio_inv' => $request['fecha_inicio_inv'],
            'fecha_fin_inv' => $request['fecha_fin_inv'],
            'publicado' => $publicado,
            'revista' => $request['revista'],
            'url' => $request['url'],
            'descripcion_inv' => $request['descripcion_inv'],
            'id_cat_inst' => $request['id_cat_inst'],
            'id_cat_pa' => $request['id_cat_pa'],
            'id_cat_idi' => $request['id_cat_idi'],
            'id_cat_tip_part' => $request['id_cat_tip_part'],
            'id_dcn' => $docente->id_pdg_dcn
        ]);

        Session::flash('apartado','8');
        Session::flash('message','Registro de investigacion realizado correctamente!');
        return Redirect::to('DashboardPerfilDocente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*$userLogin = Auth::user();
        if ($userLogin->can(['dcnInv.edit'])) {*/
            $dcnInv = dcn_inv_investigacionModel::find($id);
            $catInst = DB::table('cat_ins_institucion')->pluck("nombre_ins", "id_cat_inst");
            $catPais = DB::table('cat_pa_pais')->pluck("nombre_pais", "id_cat_pa");
            $catIdioma = cat_idi_idiomaModel::pluck("nombre_cat_idi", "id_cat_idi");
            $catTipPart = DB::table('cat_tip_part_inv_tipo_participacion_investigacion')->pluck("nombre_tip_part", "id_cat_tip_part");

            $userLogin = Auth::user();
            $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
            $idDocente = $docente->id_pdg_dcn;
            if (empty($dcnInv->id_dcn_inv)){
               return Redirect::to('/');
            }else if ($idDocente != $dcnInv->id_dcn) {
               return Redirect::to('/');
            }else{
            return view('dcnInv.edit', compact('dcnInv', 'catInst', 'catPais', 'catIdioma', 'catTipPart'));
          }
        /*} else {
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return view('template');
        }*/
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tema' => 'required|max:128',
            'fecha_inicio_inv' => 'required',
            'fecha_fin_inv' => 'required',
            'descripcion_inv' => 'required|max:512',
            'id_cat_inst' => 'required',
            'id_cat_pa' => 'required',
            'id_cat_idi' => 'required',
            'id_cat_tip_part' => 'required'
        ],
            [
                'tema.required' => 'El tema es necesario',
                'tema.max' => 'El tema debe contener como máximo 128 caracteres',
                'fecha_inicio_inv.required' => 'La fecha de inicio es necesaria',
                'fecha_fin_inv.required' => 'La fecha de fin es necesaria',
                'descripcion_inv.required' => 'La descripcion es necesaria',
                'descripcion_inv.max' => 'La descripcion debe contener como máximo 128 caracteres',
                'id_cat_inst.required' => 'La institucion es necesaria',
                'id_cat_pa.required' => 'El pais es necesario',
                'id_cat_idi.required' => 'El idioma es necesario',
                'id_cat_tip_part.required' => 'El tipo de participacion es necesario'
            ]
        );

        $userLogin = Auth::user();
        $docente = pdg_dcn_docenteModel::where("id_gen_usuario","=",$userLogin->id)->first();
        $idDocente = $docente->id_pdg_dcn;

        $dcnInv = dcn_inv_investigacionModel::find($id);
        $alumno = 0;
        $publicado = 0;
        if (isset($request["alumno"])) {
            $alumno = 1;
        }
        if (isset($request["publicado"])) {
            $publicado = 1;
        }
        $dcnInv->fill($request->all());
        $dcnInv->alumno = $alumno;
        $dcnInv->publicado = $publicado;
        $dcnInv->save();
        // Session::flash('message','Tipo Documento Modificado correctamente!');
        Session::flash('apartado','8');
        Session::flash('message','Registro de investigacion actulizado correctamente!');
        return Redirect::to('DashboardPerfilDocente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$userLogin = Auth::user();
        if ($userLogin->can(['dcnInv.destroy'])) {
            try {
                dcn_inv_investigacionModel::destroy($id);

            } catch (\PDOException $e) {
                Session::flash('message-error', 'No es posible eliminar este registro, está siendo usado.');
                return Redirect::to('dcnInv');
            }
            Session::flash('message', 'Registro eliminado correctamente!');
            return Redirect::to('dcnInv');

        } else {
            Session::flash('message-error', 'No tiene permisos para acceder a esta opción');
            return view('template');
        }*/
        dcn_inv_investigacionModel::destroy($id);
        Session::flash('message','Registro de investigacion  Eliminado Correctamente!');
        Session::flash('apartado','8');
        return Redirect::to('DashboardPerfilDocente');
    }
}
