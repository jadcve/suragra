<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\CheckSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use DB;

class EmpresaController extends Controller
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
        $empresa = Empresa::all();

        return view('empresa.index', compact('empresa'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = DB::table('empresas')
            ->where('empresa_rut', $request->empresa_rut)
            ->where('deleted_at', '=', null)
            ->exists();

        if($validate == true){
            flash('El rut '.$request->empresa_rut.'  ya existe en la base de datos')->warning();
            return redirect('/empresa');
        }else

        try {

            $empresa = new Empresa();
            $empresa->empresa_rut = $request->empresa_rut;
            $empresa->empresa_nombre = $request->empresa_nombre;
            $empresa->empresa_direccion = $request->empresa_direccion;
            $empresa->empresa_telefono = $request->empresa_telefono;

            $empresa->save();

            flash('La empresa se creo correctamente.')->success();
            return redirect('empresa');

        }catch (\Exception $e) {

            flash('Error al crear la empresa.')->error();
            //flash($e->getMessage())->error();
            return redirect('empresa');
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
        $empresa_id =  Crypt::decrypt($id);
        $empresa = Empresa::findOrfail($empresa_id);

        return view('empresa.edit', compact('empresa'));
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
        $empresa_id =  Crypt::decrypt($id);
        $empresa =  Empresa::findOrfail($empresa_id);

        try {

            $empresa->empresa_rut = $request->empresa_rut;
            $empresa->empresa_nombre = $request->empresa_nombre;
            $empresa->empresa_direccion = $request->empresa_direccion;
            $empresa->empresa_telefono = $request->empresa_telefono;

            $empresa->save();

            flash('La empresa se actualizó correctamente.')->success();
            return redirect('empresa');

        }catch (\Exception $e) {
           // dd($e);

            flash('Error al actualizar la empresa.')->error();
           //flash($e->getMessage())->error();
            return redirect('empresa');
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
        $empresa_id =  Crypt::decrypt($id);

        try {
            $empresa = Empresa::findOrfail($empresa_id)->delete();

            flash('Los datos de la empresa han sido eliminados satisfactoriamente.')->success();
            return redirect('empresa');
        }catch (\Exception $e) {

            flash('Error al intentar eliminar los datos de la empresa.')->error();
            //flash($e->getMessage())->error();
            return redirect('empresa');
        }
    }
}
