<?php

namespace App\Http\Controllers;

use App\Models\AlarmaUser;
use App\Models\Alarma;
use App\Models\Periodicidad;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Crypt;
use App\Mail\CreacionAlarma;
use App\Mail\AlarmaIva;
use Illuminate\Support\Facades\Mail;
use App\Models\Cuenta;

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

            $this->sendmailCreacion($request,  $alarma->alarma_id);


            flash('La alarma se creo correctamente.')->success();
            return redirect('alarma');

        }catch (\Exception $e) {

            flash('Error al crear la alarma.')->error();
            flash($e->getMessage())->error();
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

        $clientes = User::all();

        $periodicidad = DB::table('periodicidads')
            ->select('periodicidad_id', 'periodicidad_tipo')
            ->pluck('periodicidad_tipo', 'periodicidad_id');

        $alarma = Alarma::with('periodicidad')
            ->join('alarma_users','alarma_users.alarma_id','alarmas.alarma_id')
            ->join('users','users.user_id','alarma_users.user_id')
            ->where('alarmas.alarma_id',$id)
            ->get();


            return view('alarma.edit', compact('alarma','periodicidad', 'clientes'));

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
        $alarma_id =  Crypt::decrypt($id);


        try {
            $alarma = Alarma::findOrfail($alarma_id);
            $alarma->alarma_subject = $request->alarma_subject;
            $alarma->alarma_nombre = $request->alarma_titulo;
            $alarma->alarma_contenido = $request->alarma_contenido;
            $alarma->periodicidad_id = $request->alarma_periodicidad;
            $alarma->save();

            $alarmaClientes = AlarmaUser::where('alarma_id', $alarma_id)->delete();

            foreach($request->clientes as $clientes)
            {
                $nuevaAlarma = new AlarmaUser();
                $nuevaAlarma->alarma_id =  $alarma->alarma_id;
                $nuevaAlarma->user_id = $clientes;
                $nuevaAlarma->save();
            }


            flash('Los datos de la alarma han sido modificados correctamente.')->success();
            return redirect('alarma');

        }catch (\Exception $e) {

            flash('Error al actualizar los datos de la alarma.')->error();
            flash($e->getMessage())->error();
            return redirect('alarma');
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

    public function sendmailCreacion($datos, $id)
    {
        $email = "alain.diaz.2612@gmail.com";
        $data = [
            'message'       => "Los Datos de configuración de la alarma que se generó son los siguientes: " ,
            'alarmaId'      =>  'ID de la alarma: ' . $id,
            'nombreAlarma'  =>  'Titulo de la alarma: '. $datos->alarma_titulo,
            'subject'       => 'Alarma creada con exito' ,
        ];


        Mail::to($email)->send(new CreacionAlarma($data));
        return response()
                    ->json([
                        'mensaje' => 'Su correo fue enviado exitosamente',
                        'status'  => 'OK'
                    ]);
    }

    public function testConexion()
    {
      /*$bd =  Schema::connection('sqlsrv');
      dd($bd);*/

    }

}
