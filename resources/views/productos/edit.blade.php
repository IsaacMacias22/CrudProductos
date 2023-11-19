@extends('layouts.app')

@section('container')
    <h1 class="text-center">Editar Producto</h1>
    <div class="container w-75">
        <form action="{{route('ProductosUpdate', $producto->id)}}" method="POST">
            {{-- Seguridad y Verifiación con csrf --}}
            @csrf @method('PATCH')
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre', $producto->nombre)}}">
                @error('nombre')
                    <div style="color:red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{old('descripcion', $producto->descripcion)}}">
                @error('descripcion')
                    <div style="color:red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" name="precio" id="precio" class="form-control" value="{{old('precio', $producto->precio)}}">
                @error('precio')
                    <div style="color:red">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{route('ProductosIndex')}}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
@endsection