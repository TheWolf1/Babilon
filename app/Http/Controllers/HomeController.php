<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Servicio;
use App\PrecioPorProducto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clientes = Cliente::all();
        $pxps = PrecioPorProducto::join('servicio','servicio.id','=','precio_x_producto.servicio_id')->select('precio_x_producto.*','servicio.servicio_nombre')->get();
        return view('admin.home.index',compact('clientes','pxps'));
    }
}
