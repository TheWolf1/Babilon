<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cliente;
use App\PrecioPorProducto;
use App\Ingreso;
use App\User;
use Carbon\Carbon;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        $ingresos = Ingreso::join('cliente','cliente.cliente_id','=','ingresos.cliente_id')
        ->join('users','users.id','=','ingresos.creador_id')->select('ingresos.*','cliente.cliente_nombre','users.name')->get();
        $total = Ingreso::sum('total_pago');

        return view('admin.ingresos.index',compact('ingresos','total','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function crear(Request $request)
    {
        //
        $id = $request['id'];
        $cliente = Cliente::where('cliente_id',$id)->get()->first();
        $id_cliente = $cliente['cliente_id'];
        $id_creador = auth()->user()->id;
        $comprobante = $request['comprobante'];

        $pxp = PrecioPorProducto::where('pxp_id',$cliente['servicio_id'])->get()->first();
        $precio = $pxp['precio'];

        $ingresos = new Ingreso();
        $ingresos->creador_id = $id_creador;
        $ingresos->cliente_id = $id_cliente;
        $ingresos->comprobante = $comprobante;
        $ingresos->total_pago = $precio;
        $ingresos->save();

        Cliente::where('cliente_id',$id)->update([
            'pago'=>1
        ]);
        return $precio;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function filtrar(Request $request)
    {
        //
        $fechI =  Carbon::parse($request['fechaInit'])->toDateString();
        $fechF =  Carbon::parse($request['fechaEnd'])->toDateString();
        $userId = $request['usuario'];
        $users = User::all();

        

        if ($request['usuario'] != 0) {
            # code...
            
            $ingresos = Ingreso::join('cliente','cliente.cliente_id','=','ingresos.cliente_id')
            ->join('users','users.id','=','ingresos.creador_id')
            ->select('ingresos.*','cliente.cliente_nombre','users.name')
            ->where('ingresos.creador_id',$userId)
            ->where("ingresos.created_at",">=",$fechI)
            ->where("ingresos.created_at","<=",$fechF)->get();
    
            $total = Ingreso::where('creador_id',$userId)
            ->where("created_at",">=",$fechI)
            ->where("created_at","<=",$fechF)
            ->sum('total_pago');
        }else{
            $ingresos = Ingreso::join('cliente','cliente.cliente_id','=','ingresos.cliente_id')
            ->join('users','users.id','=','ingresos.creador_id')
            ->select('ingresos.*','cliente.cliente_nombre','users.name')
            ->where("ingresos.created_at",">=",$fechI)
            ->where("ingresos.created_at","<=",$fechF)->get();
    
            $total = Ingreso::where("created_at",">=",$fechI)
            ->where("created_at","<=",$fechF)
            ->sum('total_pago');
        }
       

        return view('admin.ingresos.index',compact('ingresos','total','users'));
        
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
