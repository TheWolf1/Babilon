<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;
use App\Servicio;
use App\PrecioPorProducto;
use App\User;

class HomeController extends Controller
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

        if (auth()->user()->rol_id== 1) {


            $clientes = Cliente::join('precio_x_producto','precio_x_producto.pxp_id','=','cliente.servicio_id')
            ->join('users','users.id','=','cliente.creador_id')
            ->join('correo','correo.correo_id','=','cliente.correo_id')
            ->join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')
            ->select('cliente.*','users.name','correo.correo_correo','correo.correo_password','correo.perfil','servicio.servicio_nombre','precio_x_producto.precio','precio_x_producto.dispositivo')
            ->where('pago',0)->get();
           

            $ClVencidos= Cliente::join('precio_x_producto','precio_x_producto.pxp_id','=','cliente.servicio_id')
            ->join('users','users.id','=','cliente.creador_id')
            ->join('correo','correo.correo_id','=','cliente.correo_id')
            ->join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')
            ->where('cliente.fecha_finaliza',"<=",$fechaActual)
            ->select('cliente.*','users.name','correo.correo_correo','correo.correo_password','correo.perfil','servicio.servicio_nombre','precio_x_producto.precio','precio_x_producto.dispositivo')
            ->get();


            $clientesAD = Cliente::join('precio_x_producto','precio_x_producto.pxp_id','=','cliente.servicio_id')
            ->join('users','users.id','=','cliente.creador_id')
            ->join('correo','correo.correo_id','=','cliente.correo_id')
            ->join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')
            ->select('cliente.*','users.name','correo.correo_correo','correo.correo_password','correo.perfil','servicio.servicio_nombre','precio_x_producto.precio','precio_x_producto.dispositivo')
            ->where('pago',0)->where('cliente.creador_id',auth()->user()->id)->get();


            $ClVencidosAD= Cliente::join('precio_x_producto','precio_x_producto.pxp_id','=','cliente.servicio_id')
            ->join('users','users.id','=','cliente.creador_id')
            ->join('correo','correo.correo_id','=','cliente.correo_id')
            ->join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')
            ->where('cliente.fecha_finaliza',"<=",$fechaActual)
            ->where('cliente.creador_id',auth()->user()->id)
            ->select('cliente.*','users.name','correo.correo_correo','correo.correo_password','correo.perfil','servicio.servicio_nombre','precio_x_producto.precio','precio_x_producto.dispositivo')
            ->get();


        }else{

            $ClVencidosAD="";
            $clientesAD="";
            $clientes = Cliente::join('precio_x_producto','precio_x_producto.pxp_id','=','cliente.servicio_id')
            ->join('users','users.id','=','cliente.creador_id')
            ->join('correo','correo.correo_id','=','cliente.correo_id')
            ->join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')
            ->select('cliente.*','users.name','correo.correo_correo','correo.correo_password','correo.perfil','servicio.servicio_nombre','precio_x_producto.precio','precio_x_producto.dispositivo')
            ->where('pago',0)->where('cliente.creador_id',auth()->user()->id)->get();

           

            $ClVencidos= Cliente::join('precio_x_producto','precio_x_producto.pxp_id','=','cliente.servicio_id')
            ->join('users','users.id','=','cliente.creador_id')
            ->join('correo','correo.correo_id','=','cliente.correo_id')
            ->join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')
            ->where('cliente.fecha_finaliza',"<=",$fechaActual)
            ->where('cliente.creador_id',auth()->user()->id)
            ->select('cliente.*','users.name','correo.correo_correo','correo.correo_password','correo.perfil','servicio.servicio_nombre','precio_x_producto.precio','precio_x_producto.dispositivo')
            ->get();
        }

        $pxps = PrecioPorProducto::join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')->get();

        return view('admin.home.index',compact('clientes','pxps','ClVencidos','clientesAD','ClVencidosAD'));
        
  
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
