<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;
use \App\gen_UsuarioModel;
use \App\User;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;

class gen_UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	/**
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios =gen_UsuarioModel::all();
        foreach ($usuarios as $usuario ) {
            $user=User::find($usuario->id);
            $roles=$user->getRoles();
            $linea="";
            foreach ($roles as $rol) {
                $linea.=$rol."#";
            }
            $username=$usuario->user;
            $rolesView[$username]=$linea;
        }
        return view('usuario.index',compact('usuarios','rolesView'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$perfiles =tbl_perfil::lists('nombrePerfil', 'idPerfil');
       // return view('usuario.create',compact('perfiles'));
        //$roles = [''=>'Seleccione un rol'] + Role::pluck('name', 'id')->toArray();
        $roles =  Role::pluck('name', 'id')->toArray();
    	return view('usuario.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha=date('Y-m-d');
            $validatedData = $request->validate([
                'name' => 'required|max:50',
                'user' => 'required|unique:gen_usuario|max:30',
                'password' => 'required|confirmed|min:6',
                'email' => 'required|unique:gen_usuario|max:250|email',
                'rol' => 'required'
            ]);
           $lastId = gen_UsuarioModel::create
            ([
                'name'       	 => $request['name'],
                'user'       	 => $request['user'],
                'email'  		 => $request['email'],
                'password'       => $request['password']
            ]);
           
               $usuario= User::find($lastId->id);
               foreach ($request['rol'] as $rol) {
                   $usuario->assignRole($rol);
               }
               //$usuario->assignRole($request['rol']);       
        Return redirect('/usuario')->with('message','Usuario Registrado correctamente!') ;
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
        $usuario=gen_UsuarioModel::find($id);
        $user=User::find($id);
        $roles=$user->getRoles();
        $rolesBd = Role::all();
        $select = "<select name='rol[]' multiple ='multiple' class='form-control' id='roles'>"; 
        foreach ($rolesBd as $rolBd ) {
           $flag=0;
           foreach ($roles as $rol ) {
               if ($rolBd->slug == $rol ) {
                   $flag=1;
               }
           }
           if ($flag == 1) {
               $select .= "<option value='".$rolBd->id."' selected>".$rolBd->name."</option>"; 
           }else{
                $select .= "<option value='".$rolBd->id."'>".$rolBd->name."</option>"; 
           }
        }
        $select .= "</select>";
       return view('usuario.edit',compact(['usuario','select','roles']));
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
        $usuario=gen_UsuarioModel::find($id);
        $user=User::find($id);
        $usuario->fill($request->all()); 
        $usuario->save();
        $user->syncRoles($request['rol']);
        Session::flash('message','Usuario Modificado correctamente!');
        return Redirect::to('/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $user=User::find($id);
         $user->revokeAllRoles();
        gen_UsuarioModel::destroy($id);
        Session::flash('message','Usuario Eliminado Correctamente!');
        return Redirect::to('/usuario');
    }

    
}
