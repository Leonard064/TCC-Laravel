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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('total_pedido',7,2);
            $table->string('frete_tipo',5);
            $table->decimal('frete_valor',5,2);
            $table->string('pagamento_tipo',10);
            $table->string('status',50);
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
        Schema::dropIfExists('pedidos');
    }
};
