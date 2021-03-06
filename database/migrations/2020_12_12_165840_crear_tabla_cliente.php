<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('cliente_id');
            $table->unsignedBigInteger('creador_id');
            $table->string('cliente_nombre',50);
            $table->string('cliente_telefono',12);
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('correo_id');
            $table->boolean('pago');
            $table->timestamps();

            $table->foreign('creador_id','cliente_creador_fk')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('servicio_id','cliente_servicio_fk')->references('pxp_id')->on('precio_x_producto')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('correo_id','cliente_correo_fk')->references('correo_id')->on('correo')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
