@extends('layouts.layout')

@section('titulo')
    Precio por producto
@endsection


@section('css')
    
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              @if (Auth::user()->rol_id == '1')
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg">Nuevo @yield('titulo')</button>
              @endif
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap DataTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Servicio</th>
                <th>Dispositivo</th>
                <th>Precio</th>
                @if (Auth::user()->rol_id == '1')
                <th></th>
                @endif
                
                
              </tr>
            </thead>
            <tbody>
              @foreach ($pxps as $pxp)
              <tr>
                <td>{{$pxp->pxp_id}}</td>
                <td>{{$pxp->servicio_nombre}}</td>
                <td>{{$pxp->dispositivo}}</td>
                <td>${{$pxp->precio}}</td>
                @if (Auth::user()->rol_id == '1')
                <td>
                  <a href="" class="mr-3">
                    <i class="fa fa-pen"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-trash" style="color:red;"></i>
                  </a>
                </td>
                @endif
              </tr>
              @endforeach
             
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- Modal crear -->
  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear @yield('titulo')</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('crear_pxp')}}" method="post">
                @include('admin.precioxproducto.form')
                <div class="row float-right">
                    <button type="submit" class="btn btn-success ">Guardar</button>
                </div>
            </form>
            
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

       
@endsection