@extends('layouts.layout')

@section('titulo')
    Roles
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
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg">Nuevo Usuario</button>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap DataTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($rols as $rol)
              <tr>
                <td>{{$rol->id}}</td>
                <td>{{$rol->nombre}}</td>
                <td>
                  <a href="" class="mr-3">
                    <i class="fa fa-pen"></i>
                  </a>
                  <a href="">
                    <i class="fa fa-trash" style="color:red;"></i>
                  </a>
                </td>
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
          <h4 class="modal-title">Crear Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @include('auth.register')
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

   
@endsection

@section('js')
    
@endsection