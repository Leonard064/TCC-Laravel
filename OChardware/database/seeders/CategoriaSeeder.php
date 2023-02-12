<?php

/**
 *  Classe Seeder para Categorias
 *
 *  Popula automaticamente a tabela com as categorias padrão
 *
 *  usando o comando "php artisan migrate:fresh --seed --seeder=CategoriaSeeder"
 *
*/

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'nome' => 'Processadores'
        ]);

        DB::table('categorias')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'nome' => 'Placas-Mãe'
        ]);

        DB::table('categorias')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'nome' => 'Placas de Vídeo'
        ]);

        DB::table('categorias')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'nome' => 'Memórias'
        ]);

        DB::table('categorias')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'nome' => 'Monitores'
        ]);

        DB::table('categorias')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'nome' => 'Mouse e Teclado'
        ]);

        DB::table('categorias')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'nome' => 'HDs e SSDs'
        ]);

        DB::table('categorias')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'nome' => 'Fontes'
        ]);
    }
}
