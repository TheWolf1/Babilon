<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCorreo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correo', function (Blueprint $table) {
            $table->id('correo_id');
            $table->unsignedBigInteger('creador_id');
            $table->unsignedBigInteger('servicio_id');
            $table->string('correo_correo',50);
            $table->string('correo_password',50);
            $table->integer('perfil');
            $table->date('fecha_finaliza');
            $table->timestamps();

            $table->foreign('creador_id','correo_user_fk')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('servicio_id','correo_servicio_fk')->references('servicio_id')->on('servicio')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('correo');
    }
}
