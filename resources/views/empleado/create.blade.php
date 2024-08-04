@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ url('/empleado')}}" method="post"  enctype="multipart/form-data"> <!--enctype="multipart/form-data" sirve para poder enviar fotos como info-->
        @csrf
        @include('empleado.form',['modo' => 'Crear'])

    </form>
</div>
@endsection