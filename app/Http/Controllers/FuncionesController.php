<?php

namespace App\Http\Controllers;

use App\Funcion;

use Illuminate\Http\Request;

class FuncionesController extends Controller
{
    public function index() {
        $funciones = Funcion::all();
        $argumentos = array();
        $argumentos['funciones'] = $funciones;

        return view('funciones.index',$argumentos);
    }

    public function create() {
        return view('funciones.create');
    }


    //
    public function store(Request $request) {
        $funcnueva = new Funcion();
        $funcnueva->pelicula = $request->input('pelicula');
        $funcnueva->fecha = $request->input('fecha');
        $funcnueva->hora = $request->input('hora');

        if ($funcnueva->save()) {
            return redirect()->route('funciones.index')->with('exito', 'La función ha sido guardada con exito');
        }
        
        return redirect()->route('funciones.index')->returnwith('error', "No se pudo añadir");
    }
    
    public function destroy($id) {
        $funcion = Funcion::find($id);
       
        if($funcion->delete()) {
            return redirect()->route('funciones.index')->with('exito', 'La función fue eliminada con exito');
        }
        
        return redirect()->route('funciones.index')->with('error', 'No se puede eliminar la funcion correctamente');
    }
}

