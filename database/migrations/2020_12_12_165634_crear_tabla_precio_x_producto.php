<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPrecioXProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precio_x_producto', function (Blueprint $table) {
            $table->id('pxp_id');
            $table->unsignedBigInteger('servicio_id');
            $table->integer('dispositivo');
            $table->double('precio',5.2);
            $table->timestamps();

            $table->foreign('servicio_id','pxp_servicio_fk')->references('servicio_id')->on('servicio')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precio_x_producto');
    }
}
