<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApartamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartamentos',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('numero');
                $table->string('bloco');
                $table->string('telefone');
                $table->boolean('enviado');
                $table->unsignedBigInteger('cliente_id');
                $table->foreign('cliente_id')
                    ->references('id')
                    ->on('clientes');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartamentos');
    }
}
