<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retornar todos los estudiantes
        return Estudiante::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $e = Estudiante::create($inputs);
        // Que recibimos del front
        return response()->json([
            'data'=>$e,
            'mensaje'=>"Estudiante creado con éxito.",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $e = Estudiante::find($id);
        if(isset($e)){
            return response()->json([
                'data'=>$e,
                'mensaje'=>"Estudiante encontrado con éxito.",
            ]);
        } else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el estudiante.",
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // e -> Estudiante
        // Busca al estudiante
        $e = Estudiante::find($id);
        // Hace la validación de si existe
        if(isset($e)) {
            $e->nombre = $request->nombre;
            $e->apellido = $request->apellido;
            $e->foto = $request->foto;
            // Si el estudiante existe hace la modificación de la data y guardar cambios
            if($e->save()) {
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Estudiante actualizado con éxito.",
                ]);
            } else {
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No se actualizo el estudiante.",
                ]);
            }
        // Sino hay estudiante responde mensaje de error
        } else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el estudiante.",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Con esto verificamos que el estudiante que deseamos eliminar exista
        $e = Estudiante::find($id);
        if(isset($e)){
            $res = Estudiante::destroy($id);
            if ($res) {
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Estudiante eliminado con éxito.",
                ]);
            } else {
                return response()->json([
                    'error'=>$e,
                    'mensaje'=>"Estudiante no existe.",
                ]);
            }
        // Sino hay estudiante responde mensaje de error
        } else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el estudiante.",
            ]);
        }
    }
}
