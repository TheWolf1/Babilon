@csrf
<input type="text" id="UpCorreoId" name="idCorreo" hidden>
<div class="form-group row">
    <label for="Upservicio" class="col-md-4 col-form-label text-md-right">Servicio:</label>

    <div class="col-md-6">
        <select name="Upservicio" id="Upservicio" class="form-control">
            @foreach ($servicios as $servicio)
                <option value="{{$servicio->servicio_id}}">{{$servicio->servicio_nombre}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="Upcorreo" class="col-md-4 col-form-label text-md-right">Correo:</label>

    <div class="col-md-6">
        <input id="Upcorreo" type="text" class="form-control " name="Upcorreo" value="{{ old('correo') }}" required autocomplete="Upcorreo" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="Uppassword" class="col-md-4 col-form-label text-md-right">Contraseña:</label>

    <div class="col-md-6">
        <input id="Uppassword" type="text" class="form-control " name="Uppassword" value="{{ old('password') }}" required autocomplete="Uppassword" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="Upperfiles" class="col-md-4 col-form-label text-md-right">Perfiles:</label>

    <div class="col-md-6">
        <input id="Upperfiles" type="number" class="form-control " name="Upperfiles" value="{{ old('perfiles') }}" required autocomplete="Upperfiles" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="UpFecha_finaliza" class="col-md-4 col-form-label text-md-right">Fecha finaliza:</label>

    <div class="col-md-6">
        <input id="UpFecha_finaliza" type="text" class="form-control " name="UpFecha_finaliza" value="{{ old('Fecha finaliza') }}" required autocomplete="UpFecha_finaliza" autofocus>
    </div>
</div>