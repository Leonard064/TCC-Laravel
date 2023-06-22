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
        Schema::create('prod__vendidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome_produto', 255);
            $table->decimal('valor_unitario',10,2);
            $table->integer('quantidade');

            $table->unsignedBigInteger('id_pedido');

            $table->foreign('id_pedido')
                                ->references('id')
                                ->on('pedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod__vendidos');
    }
};
