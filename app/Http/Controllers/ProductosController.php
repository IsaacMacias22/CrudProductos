<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     * Mostrar todos los elementos (listarlos)
     */
    public function __construct()
    {
        $this->middleware('auth'); //Crear constructor solo cuando pase por autentificación
    }
    
    public function index()
    {
        //$productos = Producto::all();
        //$productos = Producto::paginate(5);
        $productos = Producto::with('categoria:id,nombre')->paginate(5);
        //dd($productos); // ver que trae la variable
        return view('productos.index', ['productos'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     * Mandar a llamar a una vista desde otra
     */
    public function create()
    {
        $categorias = categoria::all();
        return view('productos.create', ['categorias'=>$categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:5|max:30',
            'descripcion' => 'required|min:5|max:100',
            'precio' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'categoria' => 'required | exists:categorias,id'
        ]);

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'categoria_id' =>$request->categoria
        ]);

        session()->flash('status', 'Se guardó el producto '.$request->nombre.' correctamente.');

        return to_route('ProductosIndex'); //Llamamos la ruta para que la web vuelva a llamar al controlador de index y se vuelva a paginar con el nuevo registro
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * Mostrar formulario para editar el recurso especificado
     */
    public function edit(string $id)
    {
        $producto = Producto::find($id);
        return view('productos.edit', ['producto'=>$producto]); //Retornar hacia productos edit para enviar los datos y enviamos arreglo de productos
    }

    /**
     * Update the specified resource in storage.
     * Actualizar un recurso especifuci en el almacenamiento DB
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|min:5|max:30',
            'descripcion' => 'required|min:5|max:100',
            'precio' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/']
        ]);
        $producto = Producto::find($id);

        if($producto) //Asignar valores a objeto con la información que viaja para posteriormente guardarla
        {
            $producto->nombre = $request->input('nombre');
            $producto->descripcion = $request->input('descripcion');
            $producto->precio = $request->input('precio');
        }
        $producto->save();

        session()->flash('status', 'Se actualizó el producto '.$request->nombre.' correctamente.');

        return to_route('ProductosIndex');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);

        if($producto) 
        {
            $producto->delete();   
        }

        session()->flash('status', 'Se eliminó el producto correctamente.');

        return to_route('ProductosIndex');
    }
}
