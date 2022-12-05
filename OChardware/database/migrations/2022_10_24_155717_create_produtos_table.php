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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome',255);

            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_marca');

            $table->decimal('preco', 10,2);
            $table->text('descricao');
            $table->string('foto');
            $table->float('largura');
            $table->float('altura');
            $table->float('comprimento');
            $table->float('peso');
            $table->integer('quantidade');

            $table->foreign('id_categoria')
                                ->references('id')
                                ->on('categorias');

            $table->foreign('id_marca')
                                ->references('id')
                                ->on('marcas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
};
