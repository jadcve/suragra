<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\Empresa;
use Illuminate\Support\Facades\Crypt;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes_index = User::with('belongsToEmpresa')->where('empresa_id', '!=' ,1)->get();

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

        $validate = $this->validateUser($request);

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
            $user->estado_id = 2;
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
        $id =  Crypt::decrypt($id);

        $usuario = User::with('belongsToEmpresa')->findOrfail($id);

        $empresas = DB::table('empresas')
            ->select('empresa_id', 'empresa_nombre')
            ->where('deleted_at', null)
            ->where('empresa_id', '!=' ,1)
            ->pluck('empresa_nombre', 'empresa_id');

      //  dd($usuario);

        return view('cliente.edit', compact('usuario','empresas'));
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
        $user_id =  Crypt::decrypt($id);

        try {
            $user = User::findOrfail($user_id);

            $user->user_nombre = $request->user_nombre;
            $user->user_apellido = $request->user_apellido;
            $user->user_rut = $request->user_rut;
            $user->user_cargo = $request->user_cargo;
            $user->email = $request->user_email;
            $user->empresa_id = $request->empresa_id;
            $user->user_telefono = $request->user_telefono;

            $user->save();

            flash('Los datos del usuario han sido modificado correctamente.')->success();
            return redirect('cliente');

        }catch (\Exception $e) {


            flash('Error al actualizar los datos del usuario.')->error();
            //flash($e->getMessage())->error();
            return redirect('cliente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id =  Crypt::decrypt($id);

        try {
            $user = User::findOrfail($user_id)->delete();

            flash('Los datos del cliente han sido eliminados satisfactoriamente.')->success();
            return redirect('cliente');
        }catch (\Exception $e) {


            flash('Error al intentar eliminar los datos del cliente.')->error();
            //flash($e->getMessage())->error();
            return redirect('cliente');
        }
    }

    public function validateUser($usuario)
    {
        return  DB::table('users')->where('email', $usuario->user_email)->exists();
    }
}
