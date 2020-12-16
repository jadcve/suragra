<?php

namespace App\Http\Controllers;

use App\Models\Cuenta;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Crypt;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentas = Cuenta::all();
        return view('cuenta.index', compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validateCuenta($request);

        if($validate == true){
            flash('El número de cuenta'.$request->cuenta_numero.'  ya existe en la base de datos')->warning();
            return redirect('/cuenta');
        }else

        try {

            $cuenta = new Cuenta();
            $cuenta->cuenta_numero = $request->cuenta_numero;
            $cuenta->cuenta_tipo = $request->cuenta_tipo;
            $cuenta->cuenta_banco = $request->cuenta_banco;

            $cuenta->save();

            flash('La cuenta se guardó correctamente.')->success();
            return redirect('cuenta');

        }catch (\Exception $e) {

            flash('Error al crear la cuenta.')->error();
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
        $cuenta_id =  Crypt::decrypt($id);
        $cuenta = Cuenta::findOrfail($cuenta_id);

        return view('cuenta.edit', compact('cuenta'));
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
        $cuenta_id =  Crypt::decrypt($id);
        $cuenta =  Cuenta::findOrfail($cuenta_id);

        try {

            $cuenta->cuenta_banco = $request->cuenta_banco;
            $cuenta->cuenta_tipo = $request->cuenta_tipo;
            $cuenta->cuenta_numero = $request->cuenta_numero;

            $cuenta->save();

            flash('La cuenta se actualizó correctamente.')->success();
            return redirect('cuenta');

        }catch (\Exception $e) {
           // dd($e);

            flash('Error al actualizar la cuenta.')->error();
           //flash($e->getMessage())->error();
            return redirect('cuenta');
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
        $cuenta_id =  Crypt::decrypt($id);

        try {
            $cuenta = Cuenta::findOrfail($cuenta_id)->delete();

            flash('Los datos de la cuenta han sido eliminados satisfactoriamente.')->success();
            return redirect('cuenta');
        }catch (\Exception $e) {

            flash('Error al intentar eliminar los datos de la cuenta.')->error();
            //flash($e->getMessage())->error();
            return redirect('cuenta');
        }
    }

    public function validateCuenta($cuenta)
    {
        return  DB::table('cuentas')
                    ->where('cuenta_numero', $cuenta->cuenta_numero)
                    ->where('deleted_at', '=', null)
                    ->exists();
    }
}
