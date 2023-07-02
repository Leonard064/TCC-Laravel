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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('login',20)->unique();
            $table->string('nome',50);
            $table->string('sobrenome',50);
            $table->string('cpf',11)->unique();
            $table->string('email',100)->unique();
            $table->string('foto');
            $table->string('senha',100); //tamanho por causa do hash
            $table->string('tipo',5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
};
