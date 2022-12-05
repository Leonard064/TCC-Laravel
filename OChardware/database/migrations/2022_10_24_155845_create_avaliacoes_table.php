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
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('texto_avaliacao',100);
            $table->boolean('gostou');

            // foreign keys
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_produto');

            $table->foreign('id_usuario')
                                ->references('id')
                                ->on('usuarios');

            $table->foreign('id_produto')
                                ->references('id')
                                ->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avaliacoes');
    }
};
