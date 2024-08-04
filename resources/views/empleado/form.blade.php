    <h1> {{ $modo }} empleado</h1>
    @if (count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-gruop">
        <label for="nombre"> Nombre</label>
        <input type="text" class="form-control" value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old('Nombre') }}" name="nombre" id="nombre">
    </div>
    <div class="form-gruop">
        <label for="apellidoPaterno">Apellido paterno</label>
        <input type="text" class="form-control" value="{{ isset($empleado->ApellidoPaterno) ? $empleado->ApellidoPaterno : old('ApellidoPaterno')}}" name="apellidoPaterno" id="apellidoPaterno">
    </div>
    <div class="form-gruop">
        <label for="apellidoMaterno">Apellido materno</label>
        <input type="text" class="form-control" value="{{ isset($empleado->ApellidoMaterno) ? $empleado->ApellidoMaterno : old('ApellidoMaterno')}}" name="apellidoMaterno" id="apellidoMaterno">
    </div>
    <div class="form-gruop">
        <label for="correo">Correo</label>
        <input type="text" class="form-control" value="{{ isset($empleado->Correo) ? $empleado->Correo : old('Correo')}}" name="correo" id="correo" width="100">
    </div>
    <div class="form-gruop">
        <label for="foto">Foto</label>
        @if(isset($empleado->Foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" alt="" width="100">
        @endif
        <input type="file" name="foto" id="foto">
    </div>


    <input class="btn btn-success" type="submit" value="{{ $modo }} datos">
    <br>
    <a class="btn btn-primary" href="{{ url('/empleado') }}">Volver</a>
