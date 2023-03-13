<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retornar todos los cursos
        return Curso::all();
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
        $c = Curso::create($inputs);
        // Tomamos lo que recibimos del front
        return response()->json([
            'data'=>$c,
            'mensaje'=>"Curso creado con éxito.",
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
        $c = Curso::find($id);
        if(isset($c)){
            return response()->json([
                'data'=>$c,
                'mensaje'=>"Curso encontrado con éxito.",
            ]);
        } else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el Curso.",
            ]);
        }
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
        // c -> Curso
        // Busca al Curso
        $c = Curso::find($id);
        // Hace la validación de si existe
        if(isset($c)) {
            $c->nombre = $request->nombre;
            $c->horas = $request->horas;
            // Si el Curso existe hace la modificación de la data y guardar cambios
            if($c->save()) {
                return response()->json([
                    'data'=>$c,
                    'mensaje'=>"Curso actualizado con éxito.",
                ]);
            } else {
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No se actualizo el Curso.",
                ]);
            }
        // Sino hay Curso responde mensaje de error
        } else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el Curso.",
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
        // Con esto verificamos que el curso que deseamos eliminar exista
        $c = Curso::find($id);
        if(isset($c)){
            $res = Curso::destroy($id);
            if ($res) {
                return response()->json([
                    'data'=>$c,
                    'mensaje'=>"Curso eliminado con éxito.",
                ]);
            } else {
                return response()->json([
                    'error'=>$c,
                    'mensaje'=>"Curso no existe.",
                ]);
            }
        // Sino hay Curso responde mensaje de error
        } else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el Curso.",
            ]);
        }
    }
}
