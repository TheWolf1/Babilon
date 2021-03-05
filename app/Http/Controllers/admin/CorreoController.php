<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Correo;
use App\Servicio;


class CorreoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $fechaActual = Carbon::createFromDate()->toDateString();
        $fechaMes = Carbon::now()->addMonth()->toDateString();
        $fechaMesMasCinco = Carbon::now()->addMonth()->addDays(5)->toDateString();

        $CRCencidos = Correo::join('servicio', 'servicio.servicio_id', '=', 'correo.servicio_id')->join('users','users.id','=','creador_id')->where('correo.fecha_finaliza',"<=",$fechaActual)->get();
        $servicios = Servicio::all();
        $correos = Correo::join('servicio', 'servicio.servicio_id', '=', 'correo.servicio_id')
        ->join('users','users.id','=','creador_id')
        ->where('perfil','>',0)
        ->where('fecha_finaliza','>=',$fechaMes)
        ->where('fecha_finaliza','<=',$fechaMesMasCinco)->get();


        
        return view('admin.correos.index',compact('correos','servicios','CRCencidos'));
        
       


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        //
        $correos = new Correo();
        $correos->creador_id = auth()->user()->id;
        $correos->servicio_id = $request['servicio'];
        $correos->correo_correo = $request['correo'];
        $correos->correo_password = $request['password'];
        $correos->perfil = $request['perfiles'];
        $correos->fecha_finaliza = Carbon::parse($request['Fecha_finaliza'])->toDateString();
        
      
        $correos->save();
        return redirect('admin/correos');
    }


    function correoTodos(){
        $servicios = Servicio::all();
        $correos = Correo::join('servicio', 'servicio.servicio_id', '=', 'correo.servicio_id')->join('users','users.id','=','creador_id')->select('correo.*','servicio.servicio_nombre','users.name')->get();
        return view('admin.correos.todos',compact('correos','servicios'));
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
    public function actualizar(Request $request)
    {
        //
        Correo::where('correo_id',$request['idCorreo'])->update([
            'correo_correo'=>$request['Upcorreo'],
            'servicio_id' => $request['Upservicio'],
            'correo_password'=>$request['Uppassword'],
            'perfil'=>$request['Upperfiles'],
            'fecha_finaliza'=>$request['UpFecha_finaliza']
        ]);
        return redirect('admin/correos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        //
        Correo::where('correo_id',$id)->delete();
        return redirect('admin/correos');
        
        
    }
}
