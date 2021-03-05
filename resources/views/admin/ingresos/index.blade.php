@extends('layouts.layout')

@section('titulo')
    Ingresos
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}">
@endsection

@section('contenido')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <div class="row my-4">
            <div class="col-lg-12">
              <form action="{{route('filtrar_ingresos')}}" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="usuario" class="col-md-1 col-form-label text-md-right">Usuario:</label>
                
                    <div class="col-md-2">
                      <select name="usuario" id="usuario" class="form-control" >
                            <option value="0" selected>Todos</option>
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    </div>

                    <label for="fechaInit" class="col-md-1 col-form-label text-md-right">Fecha inicio:</label>
                
                    <div class="col-md-2">
                        <input id="fechaInit" type="text" class="form-control " name="fechaInit" value="{{ old('fechaInit') }}" required autocomplete="off" autofocus>
                    </div>

                    <label for="fechaEnd" class="col-md-1 col-form-label text-md-right">Fecha final:</label>
                
                    <div class="col-md-2">
                        <input id="fechaEnd" type="text" class="form-control " name="fechaEnd" value="{{ old('fechaEnd') }}" required autocomplete="off" autofocus>
                    </div>

                    <div class="col-md-1">
                      <button class="btn btn-success">Filtrar</button>
                    </div>
                </div>
              </form>
            </div>
            
          </div>
          
          <table class="table table-hover text-nowrap DataTable">
            <thead class="table-dark">
              <tr>
                <th>ID</th>
                <th>Creador</th>
                <th>Cliente</th>
                <th>Comprobante</th>
                <th>Pago Total</th>
                <th>Fecha</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($ingresos as $ingreso)
                  <tr>
                    <td>{{$ingreso->ingreso_id}}</td>
                    <td>{{$ingreso->name}}</td>
                    <td>{{$ingreso->cliente_nombre}}</td>
                    <td>{{$ingreso->comprobante}}</td>
                    <td>${{$ingreso->total_pago}}</td>
                    <td>{{$ingreso->created_at}}</td>
                  </tr>
              @endforeach
            </tbody>
            <tfoot class="table-dark">
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td >${{$total}}</td>
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
@endsection


@section('js')
    <!-- DatePyker -->
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Moment JS -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script>
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
        dateFormat: 'mm/dd/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
      };
      $.datepicker.setDefaults($.datepicker.regional['es']);
      $("#fechaInit").datepicker();
      $("#fechaEnd").datepicker();
    </script>
@endsection