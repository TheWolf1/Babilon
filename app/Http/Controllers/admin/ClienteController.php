<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;
use App\Correo;
use App\Servicio;
use App\PrecioPorProducto;
use Carbon\Carbon;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (auth()->user()->rol_id== 1) {
            $clientes = Cliente::join('precio_x_producto','precio_x_producto.pxp_id','=','cliente.servicio_id')
            ->join('users','users.id','=','cliente.creador_id')
            ->join('correo','correo.correo_id','=','cliente.correo_id')
            ->join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')
            ->select('users.name','precio_x_producto.dispositivo','precio_x_producto.precio','servicio.servicio_nombre','cliente.*','correo.*')
            ->where('pago',1)
            ->get();
            $pxps = PrecioPorProducto::join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')->select('precio_x_producto.*','servicio.servicio_nombre')->get();
        }else{
            $clientes = Cliente::join('precio_x_producto','precio_x_producto.pxp_id','=','cliente.servicio_id')
            ->join('users','users.id','=','cliente.creador_id')
            ->join('correo','correo.correo_id','=','cliente.correo_id')
            ->join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')
            ->select('users.name','precio_x_producto.dispositivo','precio_x_producto.precio','servicio.servicio_nombre','cliente.*','correo.*')
            ->where('pago',1)
            ->where('cliente.creador_id',auth()->user()->id)->get();
            $pxps = PrecioPorProducto::join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')->select('precio_x_producto.*','servicio.servicio_nombre')->get();
        }

        return view('admin.clientes.index',compact('clientes','pxps'));
    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $pxp = PrecioPorProducto::where('pxp_id',$request['servicio'])->get()->first();
        $dispositivo = $pxp['dispositivo'];
        $servicio = $pxp['servicio_id'];


        //aqui va la parte del correo
        $fechaMes = Carbon::now()->addMonth()->toDateString();
        $fechaMesMasCinco = Carbon::now()->addMonth()->addDays(5)->toDateString();

        $correo = Correo::where('servicio_id',$servicio)
        ->Where('perfil','>=',$dispositivo)
        ->where('fecha_finaliza','>=',$fechaMes)
        ->where('fecha_finaliza','<=',$fechaMesMasCinco)
        ->orderBy('correo_id')->get()->first();


        
        $nombre = $request['nombre'];
        $telefono = $request['telefono'];
        $servicio = $pxp['servicio_id'];
        $correo_id = $correo['correo_id'];
        $creador_id = auth()->user()->id;
        $pago = $request['pago'];
        $fecha_finaliza = $correo['fecha_finaliza'];

        if ($pago=='true') {
            # code...
            $pagado = 1;
        }else{
            $pagado = 0;
        }

       
         
    
        //return "nombre: ".$nombre." telefono: ".$telefono." Servicio:".$servicio." Correo:".$correo_id." Creador: ".$creador_id." Pago: ".$pagado." Fecha finaliza: ".$fecha_finaliza;


    
        try {
            
            $cliente = new Cliente();
            $cliente->creador_id = $creador_id;
            $cliente->cliente_nombre = $nombre;
            $cliente->cliente_telefono = $telefono;
            $cliente->servicio_id = $request['servicio'];
            $cliente->correo_id = $correo_id;
            $cliente->pago = $pagado;
            $cliente->fecha_finaliza = $fecha_finaliza;
            $cliente->save();

            $perfilesL = Correo::where('correo_id',$correo_id)->select('perfil')->get()->first();
            $restaPerfil = $perfilesL['perfil'] - $dispositivo;

            Correo::where('correo_id',$correo_id)->update([
                'perfil' => $restaPerfil
            ]);

            
            return [
                "correo"=>$correo['correo_correo'],
                "password"=>$correo['correo_password'],
                "dispositivos" => $dispositivo,
                "fecha_finaliza" => $correo['fecha_finaliza'],
                "nombre" => $nombre
            ];
        } catch (\Throwable $th) {
            return $th;
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function PasarNoPagos()
    {
        //
        $Idc= auth()->user()->id;
        $fechaActual = Carbon::createFromDate()->toDateString();
        $fechaUnMes = Carbon::createFromDate()->addMonth();
        Cliente::Join('correo','correo.correo_id','=','cliente.correo_id')->where('correo.fecha_finaliza',"<=",$fechaActual)->where('cliente.creador_id',$Idc)->update([
            'pago'=>0
        ]);
        return redirect('admin/home');
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
    public function eliminar(Request $request)
    {
        //
        //Cliente::where('id',$id)->delete();
        //return redirect('admin/home');
        $dispositivos  = Correo::where('correo_correo',$request['co'])->select('perfil')->get()->first();
        $sumaDis = $dispositivos['perfil']+$request['dis'];
        Correo::where('correo_correo',$request['co'])->update([
            'perfil'=>$sumaDis
        ]);
        Cliente::where('cliente_id',$request['id'])->delete();
        return "todo salio bien";
    }
}
