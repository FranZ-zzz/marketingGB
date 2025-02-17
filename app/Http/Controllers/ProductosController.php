<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $productos = Productos::with('categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([

            'codigo' => 'required|unique:productos,codigo',
            'nombre' => 'required',
            'stock' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',
            
        ]);

        $producto = new Productos();

        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->empresa_id = Auth::user()->empresa_id;

        if($request->hasFile('imagen')){
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();


        return redirect()->route('admin.productos.index')
        ->with('mensaje','CURSO REGISTRADO')
        ->with('icono','success');

        $product = Productos::create($validatedData);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $producto = Productos::find($id);
        return view('admin.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $producto = Productos::find($id);
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([

            'codigo' => 'required|unique:productos,codigo,'.$id,
            'nombre' => 'required',
            'stock' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required',
            'fecha_ingreso' => 'required',
            
        ]);

        $producto = Productos::find($id);

        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->stock_maximo = $request->stock_maximo;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->fecha_ingreso = $request->fecha_ingreso;
        $producto->categoria_id = $request->categoria_id;
        $producto->empresa_id = Auth::user()->empresa_id;

        if($request->hasFile('imagen')){
            Storage::delete('public/'.$producto->imagen);
            $producto->imagen = $request->file('imagen')->store('productos', 'public');
        }

        $producto->save();


        return redirect()->route('admin.productos.index')
        ->with('mensaje','CURSO MODIFICADO')
        ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Productos::destroy($id);
        return redirect()->route('admin.productos.index')
        ->with('mensaje','CURSO ELIMINADO')
        ->with('icono','success');
    }
}
