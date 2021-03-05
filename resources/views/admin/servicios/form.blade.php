@csrf
<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    </div>
</div>

