<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retornar todos los usuarios
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Guardar un usuario
        $inputs = $request->input();
        // Cuando reciba la contraseña, encriptela
        // trim sirve para borrar espacios a la izquierda y derecha de la contraseña
        $e = User::create($inputs);
        $inputs["password"] = Hash::make(trim($request->password));
        // Que recibimos del front
        return response()->json([
            'data'=>$e,
            'mensaje'=>"Registrado con éxito.",
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
        // Mostrar usuario
        $e = User::find($id);
        if(isset($e)){
            return response()->json([
                'data'=>$e,
                'mensaje'=>"Encontrado con éxito.",
            ]);
        } else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el usuario.",
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
        // Buscar un usuario
        $e = User::find($id);
        // Hace la validación de si existe el usuario
        if(isset($e)) {
            $e->first_name = $request->first_name;
            $e->last_name = $request->last_name;
            $e->email = $request->email;
            $e->password = Hash::make($request->password); // Usamos Hash para encriptar contraseña
            // Si el usuario existe hace la modificación de la data y guardar cambios
            if($e->save()) {
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Usuario actualizado con éxito.",
                ]);
            } else {
                return response()->json([
                    'error'=>true,
                    'mensaje'=>"No se actualizo el usuario.",
                ]);
            }
        // Sino hay usuario responde mensaje de error
        } else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el usuario.",
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
        // Con esto verificamos que el usuario que deseamos eliminar exista
        $e = User::find($id);
        if(isset($e)){
            $res = User::destroy($id);
            if ($res) {
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>"Usuario eliminado con éxito.",
                ]);
            } else {
                return response()->json([
                    'error'=>$e,
                    'mensaje'=>"Usuario no existe.",
                ]);
            }
        // Sino hay Usuario responde mensaje de error
        } else {
            return response()->json([
                'error'=>true,
                'mensaje'=>"No existe el usuario.",
            ]);
        }
    }
}
