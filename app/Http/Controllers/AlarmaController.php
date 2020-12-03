<?php

namespace App\Http\Controllers;

use App\Models\AlarmaUser;
use App\Models\Alarma;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Crypt;

class AlarmaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alarmas = Alarma::with('periodicidad')->get();
        $clientes = User::all();
        $periodicidad = DB::table('periodicidads')
            ->select('periodicidad_id', 'periodicidad_tipo')
            ->pluck('periodicidad_tipo', 'periodicidad_id');

        return view('alarma.index', compact('alarmas', 'clientes', 'periodicidad'));
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

        try {

            $alarma = new Alarma();
            $alarma->alarma_subject = $request->alarma_subject;
            $alarma->alarma_nombre = $request->alarma_titulo;
            $alarma->alarma_contenido = $request->alarma_contenido;
            $alarma->periodicidad_id = $request->alarma_periodicidad;
            $alarma->save();

            foreach($request->clientes as $clientes)
            {
                $alarmaClientes = new AlarmaUser();
                $alarmaClientes->alarma_id =  $alarma->alarma_id;
                $alarmaClientes->user_id = $clientes;
                $alarmaClientes->save();
            }


            flash('La alarma se creo correctamente.')->success();
            return redirect('alarma');

        }catch (\Exception $e) {

            flash('Error al crear la alarma.')->error();
            //flash($e->getMessage())->error();
            return redirect('alarma');
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

        $alarma = Alarma::with('periodicidad')->get();
        dd($alarma);
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
        $alarma_id =  Crypt::decrypt($id);

        try {
            $alarma = Alarma::findOrfail($alarma_id)->delete();

            flash('La alarma ha sido eliminados satisfactoriamente.')->success();
            return redirect('alarma');
        }catch (\Exception $e) {


            flash('Error al intentar eliminar la alarma.')->error();
            //flash($e->getMessage())->error();
            return redirect('alarma');
        }
    }
}
