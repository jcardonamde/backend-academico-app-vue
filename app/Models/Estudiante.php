<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    public $table = "estudiantes";
    //protected $fillable = array("*"); // * significa que va agregar todos los cambios que hay en la tabla
    protected $fillable = [
        'nombre',
        'apellido',
        'foto',
        'id'
    ];


    // metodo que retorna la lista de cursos
    public function cursos() {
        return $this->belongsToMany(Curso::class,"curso_estudiante");
    }
}
