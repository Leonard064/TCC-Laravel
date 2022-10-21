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
            $table->string('categoria',50);
            $table->decimal('preco', 10,2);
            $table->text('descricao');
            $table->string('foto');
            $table->float('largura');
            $table->float('altura');
            $table->float('comprimento');
            $table->float('peso');
            $table->integer('quantidade');

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
