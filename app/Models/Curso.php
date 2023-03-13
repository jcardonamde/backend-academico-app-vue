<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public $table = "cursos";
    // * significa que va tener todos los cambios que hay en la tabla
    // protected $fillable = array("*");

    protected $fillable = [
        'nombre',
        'horas',
        'id'
    ];

    // metodo que retorna la lista de cursos
    public function estudiantes(){
        return $this->belongsToMany(Estudiante::class,"curso_estudiante");
    }
}
