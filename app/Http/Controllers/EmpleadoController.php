<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Validation\ValidatesRequests;

class EmpleadoController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(1);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:10000|mimes:jpg,png,jpgD',

        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required' => 'La foto es requerida'
        ];

        $this -> validate($request, $campos, $mensaje);


        //$datosEmpleado = $request->all();
        $datosEmpleado = $request->except('_token');//exceptuamos al token de los datos recaudados
        
        if($request-> hasFile('foto')){
            $datosEmpleado['foto'] = $request -> file('foto') -> store('uploads', 'public');
        }
        
        Empleado::insert($datosEmpleado);
        //return response()-> json($datosEmpleado); cambiamos por un redirect

        return redirect('empleado')->with('mensaje','Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {//solo muestra la edicion de los datos, para cambiarlos usamos update
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleado/edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //


        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',
        ];

        $mensaje=[
            'required'=>'El :attribute es requerido'
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto' => 'required|max:10000|mimes:jpg,png,jpgD'];
            $mensaje=['Foto.required' => 'La foto es requerida'];
        }


        $this -> validate($request, $campos, $mensaje);

        $datosEmpleado = $request->except('_token', '_method');//quitamos el token y el metodo
        
        if($request-> hasFile('foto')){
            $empleado=Empleado::findOrFail($id);//busca la imagen
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['foto'] = $request -> file('foto') -> store('uploads', 'public');
        }
        
        

        Empleado::where('id','=',$id)->update($datosEmpleado);
        $empleado=Empleado::findOrFail($id);
        //return view('empleado/edit', compact('empleado'));
        return redirect('empleado')->with('mensaje','Empleado modificado con exito');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $empleado=Empleado::findOrFail($id);

        if(Storage::delete('public/'.$empleado->Foto)){//si ya se borro entonces borro el registro
            Empleado::destroy($id);//al hacer esto se borra la imagen de storage
        }

        //
        return redirect('empleado')->with('mensaje','Empleado borrado con exito');


    }
}
