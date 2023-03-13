<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoEstudianteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_estudiante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("curso_id");
            // En caso de que existan eliminaciones en la BD borre todo en cascada
            $table->foreign("curso_id")->references("id")->on("cursos")->onDelete("cascade");

            // Se replica el caso anterior para la tabla estudiante
            $table->unsignedBigInteger("estudiante_id");
            $table->foreign("estudiante_id")->references("id")->on("estudiantes")->onDelete("cascade");

            $table->timestamps();
            // Lo anterior nos permite tener un modelo de BD de many to many
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_estudiante');
    }
}
