<?php

namespace App\Http\Controllers;

use App\Models\Alarma;
use App\User;
use Illuminate\Http\Request;
use DB;

class AlarmaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alarmas = Alarma::all();

        /*$clientes = DB::table('users')
            ->select('user_id', 'user_nombre')
            ->where('deleted_at', null)
            ->where('user_id', '!=' ,1)
            ->pluck('user_nombre', 'user_id');
        */
        $clientes = User::all();
        //dd($clientes);
        $periodicidad = DB::table('periodicidad')
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
        //
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
