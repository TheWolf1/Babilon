@csrf

<div class="form-group row">
    <label for="servicio" class="col-md-4 col-form-label text-md-right">Servicio:</label>

    <div class="col-md-6">
        <select name="servicio" id="servicio" class="form-control" >
            @foreach ($pxps as $pxp)
                <option value="{{$pxp->pxp_id}}">{{$pxp->servicio_nombre}} {{$pxp->dispositivo}} Dispositivo por ${{$pxp->precio}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre:</label>

    <div class="col-md-6">
        <input id="nombre" type="text" class="form-control " name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="telefono" class="col-md-4 col-form-label text-md-right">Telefono:</label>

    <div class="col-md-6">
        <input id="telefono" type="text" class="form-control " name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>
    </div>
</div>



<div class="form-group">
    <div class="row">
        <label for="telefono" class="col-md-4 col-form-label text-md-right">Pago:</label>
        <div class="form-check mr-3 mt-2">
            <input class="form-check-input" type="radio" name="pago" id="no_pago" value="false" checked>
            <label class="form-check-label">No Pago</label>
        </div>
        <div class="form-check mt-2">
            <input class="form-check-input" type="radio" name="pago" id="pagado" value="true" >
            <label class="form-check-label">Pagado</label>
        </div>
    </div>
  </div>
