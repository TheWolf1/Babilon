@csrf

<div class="form-group row">
    <label for="Uservicio" class="col-md-4 col-form-label text-md-right">Servicio:</label>

    <div class="col-md-6">
        <select name="Uservicio" id="Uservicio" class="form-control" >
            @foreach ($pxps as $pxp)
                <option value="{{$pxp->pxp_id}}">{{$pxp->servicio_nombre}} {{$pxp->dispositivo}} Dispositivo por ${{$pxp->precio}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="Unombre" class="col-md-4 col-form-label text-md-right">Nombre:</label>

    <div class="col-md-6">
        <input id="Unombre" type="text" class="form-control " name="Unombre" value="{{ old('Unombre') }}" required autocomplete="Unombre" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="Utelefono" class="col-md-4 col-form-label text-md-right">Telefono:</label>

    <div class="col-md-6">
        <input id="Utelefono" type="text" class="form-control " name="Utelefono" value="{{ old('Utelefono') }}" required autocomplete="Utelefono" autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="Ufecha" class="col-md-4 col-form-label text-md-right">Fecha:</label>

    <div class="col-md-6">
        <input id="Ufecha" type="text" class="form-control " name="Ufecha" value="{{ old('Ufecha') }}" required autocomplete="off"autofocus>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <label for="Utelefono" class="col-md-4 col-form-label text-md-right">Pago:</label>
        <div class="form-check mr-3 mt-2">
            <input class="form-check-input" type="radio" name="Upago" id="Uno_pago" value="false" checked>
            <label class="form-check-label">No Pago</label>
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="Upago" id="Upagado" value="true" >
            <label class="form-check-label">Pagado</label>
        </div>
    </div>
  </div>