<?php

/**
 *  Classe geradora de user ADM
 *
 */

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'login' => 'Admin',
            'nome' => 'Usuario',
            'sobrenome' => 'Administrador',
            'cpf' => 00000000000,
            'email' => 'admin@admin.com',
            'foto' => 'foto-padrao.png',
            'senha' => bcrypt('admin'),
            'tipo' => 'adm'
        ]);
    }
}
