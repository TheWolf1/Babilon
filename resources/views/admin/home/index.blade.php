@extends('layouts.layout')

@section('titulo')
    Home
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}">
@endsection

@section('contenido')


@if (Auth::user()->rol_id == '1')

<!-- Los datos de administrador -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><b>Usuarios no pagos solo administrador</b> </h3>

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
              <th>Pago</th>
              <th></th>
              
            </tr>
          </thead>
          <tbody >
            @foreach ($clientesAD as $cliente)
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
                  <td>{{$cliente->correo_correo}}</td>
                  <td>{{$cliente->fecha_finaliza}}</td>
                  <td>
                    <button class="btn btn-success" onclick="pagar({{$cliente->cliente_id}},'{{$cliente->cliente_nombre}}')">
                      Pagar
                    </button>
                    
                  </td>
                  <td>
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
                <a href="#" id="listarUsersAD">Listar</a>
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

<div class="row">
  <div class="col-12">
    <div class="card card-success card-outline">
      <div class="card-header">
        <h3 class="card-title"><b>Vencen el dia de Hoy solo administrador</b> </h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <a href="{{route('pasar_noPagos')}}"class="btn btn-danger">Pasar a no pagos</a>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap DataTable" >
          <thead class="table-dark">
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
              
              
              
            </tr>
          </thead>
          <tbody >
            @foreach ($ClVencidosAD as $ClVencido)
                <tr>
                  <td>{{$ClVencido->cliente_id}}</td>
                  @if (Auth::user()->rol_id == '1')
                  <td>{{$ClVencido->name}}</td>
                  @endif
                  <td>{{$ClVencido->cliente_nombre}}</td>
                  <td>
                    <a href="https://web.whatsapp.com/send?phone={{$ClVencido->cliente_telefono}}&text=Hola {{$ClVencido->cliente_nombre}},&app_absent=0" target="_blank">
                      {{$ClVencido->cliente_telefono}}
                    </a>
                  </td>
                  <td>{{$ClVencido->servicio_nombre}} {{$ClVencido->dispositivo}} Dispositivo por ${{$ClVencido->precio}}</td>
                  <td>{{$ClVencido->correo_correo}}</td>
                  <td>{{$ClVencido->fecha_finaliza}}</td>
                  
                  
                </tr>
            @endforeach
          
          </tbody>
          <tfoot>
            <tr>
              <td>
                <a href="#" id="listarUsersVAD">Listar</a>
              </td>
              @if (Auth::user()->rol_id == '1')
              <td></td>
              @endif
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
<hr>
<h2>Todos los usuarios</h2>
<hr>
@endif


<!-- de los usuarios  -->

<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><b>Usuarios no pagos</b> </h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              @if (Auth::user()->rol_id != '1')
              <button class="btn btn-success" data-toggle="modal" data-target="#modal-lg">Nuevo Usuario</button>
              @endif
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
                <th>Pago</th>
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
                    <td>{{$cliente->correo_correo}}</td>
                    <td>{{$cliente->fecha_finaliza}}</td>
                    <td>
                      <button class="btn btn-success" onclick="pagar({{$cliente->cliente_id}},'{{$cliente->cliente_nombre}}')">
                        Pagar
                      </button>
                      
                    </td>
                    <td>
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

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><b>Vencen el dia de Hoy</b> </h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              @if (Auth::user()->rol_id != '1')
              <a href="{{route('pasar_noPagos')}}"class="btn btn-danger">Pasar a no pagos</a>
              @endif
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap DataTable" >
            <thead class="table-dark">
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
                
                
                
              </tr>
            </thead>
            <tbody >
              @foreach ($ClVencidos as $ClVencido)
                  <tr>
                    <td>{{$ClVencido->cliente_id}}</td>
                    @if (Auth::user()->rol_id == '1')
                    <td>{{$ClVencido->name}}</td>
                    @endif
                    <td>{{$ClVencido->cliente_nombre}}</td>
                    <td>
                      <a href="https://web.whatsapp.com/send?phone={{$ClVencido->cliente_telefono}}&text=Hola {{$ClVencido->cliente_nombre}},&app_absent=0" target="_blank">
                        {{$ClVencido->cliente_telefono}}
                      </a>
                    </td>
                    <td>{{$ClVencido->servicio_nombre}} {{$ClVencido->dispositivo}} Dispositivo por ${{$ClVencido->precio}}</td>
                    <td>{{$ClVencido->correo_correo}}</td>
                    <td>{{$ClVencido->fecha_finaliza}}</td>
                    
                    
                  </tr>
              @endforeach
            
            </tbody>
            <tfoot>
              <tr>
                <td>
                  <a href="#" id="listarUsersV">Listar</a>
                </td>
                @if (Auth::user()->rol_id == '1')
                <td></td>
                @endif
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


  <!-- Modal crear -->
  <div class="modal fade" id="modal-Ingresos">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear @yield('titulo')</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <center>
          <h3>Ingresar el Pago de <span id="NomprePago"></span></h3>
        </center>
            <form id="formPagos">
              @csrf
              <div class="form-group row">
                <label for="comprobante" class="col-md-4 col-form-label text-md-right">Comprobante:</label>
            
                <div class="col-md-6">
                    <input id="comprobante" type="text" class="form-control " name="comprobante" value="{{ old('comprobante') }}" required autocomplete="comprobante" autofocus>
                </div>
            </div>
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



    <!-- Modal mostrar Correo -->
    <div class="modal fade" id="modal-correo">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Correo para el usuario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <p><b>*Nombre del perfil:* </b><span id="NompreCliente"></span></p>
            <p><b>*Fecha que finaliza:* </b><span id="DateFCliente"></span></p>
            <p><b>*Correo:* </b><span id="CorreoCliente"></span></p>
            <p><b>*Contraseña:* </b><span id="PassCliente"></span></p>
            *************************
            <p>Con estos datos puedes ingresar a tu cuenta de Netflix.
              Recuerda que solo puedes conectarte desde <span id="PerfilesCliente"></span> Dispositivo/s en caso de que te llegues a conectar de más dispositivos la cuenta se te bloquea y no la puedes usar más por esta razón no compartas tu usuario y contraseña.
              También recuerda que esta totalmente prohibido cambiar algún dato de la cuenta y en caso de que lo hagas se te quitará la cuenta y no la podrás usar más. 
              </p>
         
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    @if (Auth::user()->rol_id == '1')
     <!-- Modal Usuarios -->
     <div class="modal fade" id="modal-listarUserAD">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Usuarios Listados</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @foreach ($clientesAD as $cliente)
              <p>{{$cliente->cliente_nombre}},{{$cliente->cliente_telefono}}</p>
            @endforeach  
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal --> 
    
    <!-- Modal usuarios vencidos -->
    <div class="modal fade" id="modal-listarUserVAD">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Usuarios Vencidos Listados</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @foreach ($ClVencidosAD as $ClVencido)
            <p>{{$ClVencido->cliente_nombre}},{{$ClVencido->cliente_telefono}}</p>
          @endforeach  
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal --> 
@endif

















     <!-- Modal Usuarios -->
     <div class="modal fade" id="modal-listarUser">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Usuarios Listados</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @foreach ($clientes as $cliente)
              <p>{{$cliente->cliente_nombre}},{{$cliente->cliente_telefono}}</p>
            @endforeach  
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal --> 
    
    <!-- Modal usuarios vencidos -->
    <div class="modal fade" id="modal-listarUserV">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Usuarios Vencidos Listados</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @foreach ($ClVencidos as $ClVencido)
            <p>{{$ClVencido->cliente_nombre}},{{$ClVencido->cliente_telefono}}</p>
          @endforeach  
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal --> 
@endsection

@section('js')

    <!-- DatePyker -->
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Moment JS -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script>
      var ids;
      $("#formCliente").submit((e)=>{
        e.preventDefault();
        let fecha = $("#fecha").val();
        let date = moment(fecha,"DD-MM-YYYY").format("YYYY-MM-DD");
        
        var datos = $("#formCliente").serialize()+"&date="+date;
               
        $.ajax({
          type:'post',
          data:datos,
          url:"{{route('crear_cliente')}}",
          success:function(d){
            console.log(d);
            $("#modal-lg").modal("hide");
            $("#tblClientes").load(" #tblClientes");
            
            $("#NompreCliente").text(d.nombre);
            $("#DateFCliente").text(moment(d.fecha_finaliza,"YYYY-MM-DD").format("DD-MM-YYYY"));
            $("#CorreoCliente").text(d.correo);
            $("#PassCliente").text(d.password);
            $("#PerfilesCliente").text(d.dispositivos);

            document.getElementById("formCliente").reset();
            $("#modal-correo").modal('show');
          },
          error:function(e){
              console.log('ocurrio un error'+e);
          }

          
        });
      });

      function pagar(id,nombre){
        ids = id;
        $("#NomprePago").text(nombre);
        $("#modal-Ingresos").modal('show');
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
              document.getElementById("formPagos").reset();
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

      $("#listarUsersV").click(()=>{
        $("#modal-listarUserV").modal('show');
      });


      $("#listarUsersAD").click(()=>{
        $("#modal-listarUserAD").modal('show');
      });

      $("#listarUsersVAD").click(()=>{
        $("#modal-listarUserVAD").modal('show');
      });

      $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '< Ant',
        nextText: 'Sig >',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
      };
      $.datepicker.setDefaults($.datepicker.regional['es']);
      $("#fecha").datepicker();
    </script>
@endsection