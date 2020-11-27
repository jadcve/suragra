<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\Empresa;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes_index = User::with('belongsToEmpresa')->get();

        $empresas = DB::table('empresas')
        ->select('empresa_id', 'empresa_nombre')
        ->where('deleted_at', null)
        ->where('empresa_id', '!=' ,1)
        ->pluck('empresa_nombre', 'empresa_id');

        return view('cliente.index',compact('clientes_index', 'empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresas = DB::table('empresas')
            ->select('empresa_id', 'empresa_nombre')
            ->where('deleted_at', null)
            ->where('empresa_id', '!=' ,1)
            ->pluck('empresa_nombre', 'empresa_id');

        return view('cliente.index',compact('empresas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = DB::table('users')->where('email', $request->user_email)->exists();

        if($validate == true){
            flash('El usuario '.$request->usu_email.'  ya existe en la base de datos')->warning();
            return redirect('/cliente');
        }else

        try {

            $user = new User();
            $user->user_nombre = $request->user_nombre;
            $user->user_apellido = $request->user_apellido;
            $user->user_rut = $request->user_rut;
            $user->user_cargo = $request->user_cargo;
            $user->user_estado = 2;
            $user->email = $request->user_email;
            $user->password = bcrypt('N0EsCl4v3Par4Acc3d3r');
            $user->rol_id = 2;
            $user->user_telefono = $request->user_telefono;
            $user->empresa_id = $request->empresa_id;
            $user->save();

        flash('El cliente ha sido creado correctamente.')->success();
        return redirect('cliente');

        }catch (\Exception $e) {



            flash('Error al crear cliente.')->error();
            //dd($e);
            //flash($e->getMessage())->error();
            return redirect('cliente');
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
