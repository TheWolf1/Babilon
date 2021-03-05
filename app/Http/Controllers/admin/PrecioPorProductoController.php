<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PrecioPorProducto;
use App\Servicio;

class PrecioPorProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $servicios = Servicio::all();
        $pxps = PrecioPorProducto::join('servicio','servicio.servicio_id','=','precio_x_producto.servicio_id')->select('precio_x_producto.*','servicio.servicio_nombre')->get();
        return view('admin.precioxproducto.index',compact('pxps','servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function crear(Request $request)
    {
        //
        $pxp = new PrecioPorProducto();
        $pxp->servicio_id = $request['servicio'];
        $pxp->dispositivo = $request['dispositivo'];
        $pxp->precio = $request['precio'];
        $pxp->save();
        return redirect('admin/precio_x_producto');
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
