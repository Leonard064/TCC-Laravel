<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('cep',8);
            $table->string('endereco',100);
            $table->string('numero',5);
            $table->string('bairro',50);
            $table->string('municipio',100);
            $table->string('estado',50);

            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_usuario')
                                ->references('id')
                                ->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
};
