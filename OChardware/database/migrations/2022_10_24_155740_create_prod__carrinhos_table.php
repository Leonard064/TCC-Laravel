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
        Schema::create('prod__carrinhos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('quantidade');
            $table->unsignedBigInteger('id_produto');
            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_produto')
                            ->references('id')
                            ->on('produtos');

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
        Schema::dropIfExists('prod__carrinhos');
    }
};
