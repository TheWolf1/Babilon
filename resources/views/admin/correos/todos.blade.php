@extends('layouts.layout')

@section('titulo')
    Todos los Correos
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
            
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap DataTable">
            <thead>
              <tr>
                <th>ID</th>
                @if (Auth::user()->rol_id == '1')
                <th>Creador</th>
                @endif
                <th>Servicio</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Perfiles</th>
                <th>Fecha Finaliza</th>
               
                <th></th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ($correos as $correo)
              <tr>
                <td>{{$correo->correo_id}}</td>
                @if (Auth::user()->rol_id == '1')
                <td>{{$correo->name}}</td>
                @endif
                <td>{{$correo->servicio_nombre}}</td>
                <td>{{$correo->correo_correo}}</td>
                <td>{{$correo->correo_password}}</td>
                <td>{{$correo->perfil}}</td>
                <td>{{$correo->fecha_finaliza}}</td>
                
                <td>
                  <a href="#" class="mr-3" onclick="updateCorreo({{$correo->correo_id}},'{{$correo->correo_correo}}','{{$correo->correo_password}}',{{$correo->perfil}},'{{$correo->fecha_finaliza}}',{{$correo->servicio_id}})" >
                    <i class="fa fa-pen"></i>
                  </a>
                  <a href="{{route('eliminar_correo',$correo->correo_id)}}">
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
    <!-- Modal actualizar -->
    <div class="modal fade" id="modal-update">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Crear @yield('titulo')</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form action="{{route('actualizar_correo')}}" method="post">
                  @include('admin.correos.update')
                  <div class="row float-right">
                      <button type="submit" class="btn btn-primary ">Actualizar</button>
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

@section('js')
    <script>
      function updateCorreo(id,correo,pass,perfil,fecha,servicio) {
        //alert("correo: "+correo+" pass: "+pass+" perfil: "+perfil+" fecha: "+fecha+" servicio: "+servicio);
        $("#UpCorreoId").val(id);
        $("#Upservicio").val(servicio);
        $("#Upcorreo").val(correo);
        $("#Uppassword").val(pass);
        $("#Upperfiles").val(perfil);
        $("#UpFecha_finaliza").val(fecha);
        $("#modal-update").modal('show');
      }

      $("#Fecha_finaliza").datepicker();
    </script>
@endsection