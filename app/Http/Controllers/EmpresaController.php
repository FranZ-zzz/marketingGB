<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $paises = DB::table('countries')->get();
        $estados = DB::table('states')->get();
        $monedas = DB::table('currencies')->select('symbol', 'name')->get();
        return view('admin.empresas.create',compact('paises','estados','monedas'));
    }

    public function buscar_pais($id_pais){
        try{
            $estados = DB::table('states')->where('country_id',$id_pais)->get();
            return view('admin.empresas.cargar_estados', compact('estados'));
        }catch(\Exception $exception){
            return response()->json(['mensaje'=>'Error']);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        $datos = $request()->all();
        return response() -> json($datos);
        */

        $request->validate([
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'ruc' => 'required|unique:empresas',
            'telefono' => 'required',
            'correo' => 'required|unique:empresas',
            'cantidad_impuesto' => 'required',
            'direccion' => 'required',
            'moneda' => 'required',
            'ciudad' => 'required',
            'departamento' => 'required',
            'codigo_postal' => 'required',
            'logo' => 'required|image|mimes:jpg, jpeg, png',
        ]);

        $empresa = new Empresa();

        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->ruc = $request->ruc;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->direccion = $request->direccion;
        $empresa->moneda = $request->moneda;
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->logo = $request->file('logo')->store('logos', 'public');

        $empresa->save();

        $usuario = new User();
        $usuario->name = "Admin";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request['ruc']);
        $usuario->empresa_id = $empresa->id;
        $usuario->save();

        $usuario->assignRole('ADMINISTRADOR');

        Auth::login($usuario);

        return redirect()->route('admin.index')
        ->with('mensaje','EMPRESA REGISTRADA DE MANERA CORRECTA')
        ->with('icono','success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
        $paises = DB::table('countries')->get();
        $estados = DB::table('states')->get();
        $monedas = DB::table('currencies')->select('symbol', 'name')->get();
        $empresa_id = Auth::user()->empresa_id;
        $empresa = Empresa::where('id',$empresa_id)->first();
        $departamentos = DB::table('states')->where('country_id', $empresa->pais) ->get();
        return view('admin.configuraciones.edit',compact('paises','estados','monedas','empresa','departamentos'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'ruc' => 'required|unique:empresas,ruc,'.$id,
            'telefono' => 'required',
            'correo' => 'required|unique:empresas,correo,'.$id,
            'cantidad_impuesto' => 'required',
            'direccion' => 'required',
            'moneda' => 'required',
            'ciudad' => 'required',
            'departamento' => 'required',
            'codigo_postal' => 'required',
        ]);

        $empresa = Empresa::find($id);

        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->ruc = $request->ruc;
        $empresa->telefono = $request->telefono;
        $empresa->correo = $request->correo;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->direccion = $request->direccion;
        $empresa->moneda = $request->moneda;
        $empresa->ciudad = $request->ciudad;
        $empresa->departamento = $request->departamento;
        $empresa->codigo_postal = $request->codigo_postal;

        if($request->hasFile('logo')){
            Storage::delete('public/'.$empresa->logo);
            $empresa->logo = $request->file('logo')->store('logos', 'public');
        }

        $empresa->save();

        $usuario_id = Auth::user()->id;

        $usuario = User::find($usuario_id);
        $usuario->name = "Admin";
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request['ruc']);
        $usuario->empresa_id = $empresa->id;
        $usuario->save();

        return redirect()->route('admin.index')
            ->with('mensaje','DATOS ACTUALIZADOS')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
