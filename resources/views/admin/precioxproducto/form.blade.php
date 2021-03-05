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
    <label for="dispositivo" class="col-md-4 col-form-label text-md-right">Dispositivos:</label>

    <div class="col-md-6">
        <input id="dispositivo" type="text" class="form-control " name="dispositivo" value="{{ old('dispositivo') }}" required autocomplete="dispositivo" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="precio" class="col-md-4 col-form-label text-md-right">Precio:</label>

    <div class="col-md-6">
        <input id="precio" type="text" class="form-control " name="precio" value="{{ old('precio') }}" required autocomplete="precio" autofocus>
    </div>
</div>
