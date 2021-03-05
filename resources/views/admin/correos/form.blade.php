@csrf

<div class="form-group row">
    <label for="servicio" class="col-md-4 col-form-label text-md-right">Servicio:</label>

    <div class="col-md-6">
        <select name="servicio" id="servicio" class="form-control">
            @foreach ($servicios as $servicio)
                <option value="{{$servicio->servicio_id}}">{{$servicio->servicio_nombre}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="correo" class="col-md-4 col-form-label text-md-right">Correo:</label>

    <div class="col-md-6">
        <input id="correo" type="text" class="form-control " name="correo" value="{{ old('correo') }}" required autocomplete="correo" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña:</label>

    <div class="col-md-6">
        <input id="password" type="text" class="form-control " name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="perfiles" class="col-md-4 col-form-label text-md-right">Perfiles:</label>

    <div class="col-md-6">
        <input id="perfiles" type="number" class="form-control " name="perfiles" value="{{ old('perfiles') }}" required autocomplete="perfiles" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="Fecha_finaliza" class="col-md-4 col-form-label text-md-right">Fecha finaliza:</label>

    <div class="col-md-6">
        <input id="Fecha_finaliza" type="text" class="form-control " name="Fecha_finaliza" value="{{ old('Fecha finaliza') }}" required autocomplete="off" autofocus>
    </div>
</div>