<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaIngresos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id('ingreso_id');
            $table->unsignedBigInteger('creador_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('comprobante',50)->unique();
            $table->double('total_pago',5.2);
            $table->timestamps();

            $table->foreign('creador_id','ingreso_creador_fk')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('cliente_id','ingreso_cliente_fk')->references('cliente_id')->on('cliente')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingresos');
    }
}
