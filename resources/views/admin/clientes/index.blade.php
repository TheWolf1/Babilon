@extends('layouts.layout')

@section('titulo')
    Cliente
@endsection

@section('css')
    
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Todos los clientes</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg">Nuevo Usuario</button>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap DataTable" id="tblClientes">
            <thead>
              <tr>
                <th>ID</th>
                @if (Auth::user()->rol_id == '1')
                <th>Creador</th>
                @endif
                <th>Cliente</th>
                <th>Telefono</th>
                <th>Servicio</th>
                <th>Correo</th>
                <th>Fecha Finaliza</th>
                <th></th>
              </tr>
            </thead>
            <tbody >
              @foreach ($clientes as $cliente)
                  <tr>
                    <td>{{$cliente->cliente_id}}</td>
                    @if (Auth::user()->rol_id == '1')
                    <td>{{$cliente->name}}</td>
                    @endif
                    <td>{{$cliente->cliente_nombre}}</td>
                    <td>
                      <a href="https://web.whatsapp.com/send?phone={{$cliente->cliente_telefono}}&text=Hola {{$cliente->cliente_nombre}},&app_absent=0" target="_blank">
                        {{$cliente->cliente_telefono}}
                      </a>
                    </td>
                    <td>{{$cliente->servicio_nombre}} {{$cliente->dispositivo}} Dispositivo por ${{$cliente->precio}}</td>
                    <td>
                      <a href="#" onclick="dCorreo('{{$cliente->correo_correo}}','{{$cliente->correo_password}}','{{$cliente->fecha_finaliza}}','{{$cliente->perfil}}')">{{$cliente->correo_correo}}</a>      
                    </td>
                    <td>{{$cliente->fecha_finaliza}}</td>
                    
                    <td>
                      <a href="#" class="mr-3" onclick="editUser()">
                        <i class="fa fa-pen"></i>
                      </a>
                      <a onclick="EliminarUsuario({{$cliente->cliente_id}},'{{$cliente->correo_correo}}',{{$cliente->dispositivo}})">
                        <i class="fa fa-trash" style="color:red;"></i>
                      </a>
                    </td>
                  </tr>
              @endforeach
             
            </tbody>
            <tfoot>
              <tr>
                <td>
                  <a href="#" id="listarUsers">Listar</a>
                </td>
                @if (Auth::user()->rol_id == '1')
                <td></td>
                @endif
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tfoot>
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
            
            <form id="formCliente">
                @include('admin.home.form')
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

  <!-- Modal editar -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
            <form id="formClienteU">
                @include('admin.clientes.update')
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


 

    <!-- Modal ver correo -->
    <div class="modal fade" id="modal-Correo">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Datos del correo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              
              <h4><b>Correo:</b>  <span id="vCorreo"></span></h4>
              <h4><b>Contraseña:</b>  <span id="vContra"></span></h4>
              <h4><b>Perfiles libres:</b>  <span id="vPerfil"></span></h4>
              <h4><b>Fecha finaliza:</b>  <span id="vFecha"></span></h4>
              
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
      var ids;
      $("#formCliente").submit((e)=>{
        e.preventDefault();
        var datos = $("#formCliente").serialize();
        $.ajax({
          type:'post',
          data:datos,
          url:"{{route('crear_cliente')}}",
          success:function(d){
            console.log(d);
            $("#modal-lg").modal("hide");
            $("#tblClientes").load(" #tblClientes");

            $("#NompreCliente").text(d.nombre);
            $("#CorreoCliente").text(d.correo);
            $("#PassCliente").text(d.password);
            $("#PerfilesCliente").text(d.dispositivos);

            $("#modal-correo").modal('show');
          },
          error:function(e){
              console.log('ocurrio un error'+e);
          }

          
        });
      });

      function editUser() {
        $("#modal-edit").modal("show");
      }



      $("#formPagos").submit((e)=>{
          e.preventDefault();
          let datos = $("#formPagos").serialize()+"&id="+ids;
          $.ajax({
            type:'POST',
            data:datos,
            url: "{{route('crear_ingresos')}}",
            success:function(d){
              console.log(d);
              $("#modal-Ingresos").modal('hide');
              $("#tblClientes").load(" #tblClientes");
            },
            error:function(e){
              console.log(e);
            }
          });
      })

      function EliminarUsuario(id,correo,dispositivo){
        datos = "id="+id+"&co="+correo+"&dis="+dispositivo+"&_token={{csrf_token()}}";

        $.ajax({
          type:'post',
          url:"{{route('eliminar_cliente')}}",
          data: datos,
          success:function(d){
            $("#tblClientes").load(" #tblClientes");
          },
          error:function(e){
            console.log(e);
          }
        });
      }

      $("#listarUsers").click(()=>{
        $("#modal-listarUser").modal('show');
      });
      
      //Mostrar datos del correo
      function dCorreo(correo,password,fecha,perfil) {
        $("#vCorreo").text(correo);
        $("#vContra").text(password);
        $("#vPerfil").text(perfil);
        $("#vFecha").text(fecha);
        
        $("#modal-Correo").modal("show");
      }
    </script>
@endsection