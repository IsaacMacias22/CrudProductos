@extends('layouts.app_principal')

@section('container')
<h1 class="text-center">Registro</h1>
<div class="container w-75">
    <form action="{{route('RegistroStore')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" placeholder="Escribe tu nombre">
            @error('name')
                <div style="color:red">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="username" class="form-label">Usuario</label>
            <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}" placeholder="Crea un usuario">
            @error('username')
                <div style="color:red">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{old('email')}}" placeholder="Escribe tu correo electrónico">
            @error('email')
                <div style="color:red">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group mt-2">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Escribe una contraseña">
        </div>
        <div class="form-group mt-2">
            <label for="password_confirmation" class="form-label">Repetir Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Repite la contraseña">
            @error('password')
                <div style="color:red">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Crear cuenta</button>
            <a href="{{route('Dashboard')}}" class="btn btn-danger">Cancelar</a>
        </div>
    </form>
</div>
@endsection