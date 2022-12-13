<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; //para autenticação

class Usuario extends Model implements Authenticatable
{
    use HasFactory;
    protected $table = 'usuarios';
    protected $fillable = ['login','nome','sobrenome','cpf','email','foto','senha','tipo'];

    /**
        * Get all of the prod_carrinho for the Usuario
    */
    public function prods_carrinho(){

        return $this->hasMany(Prod_Carrinho::class, 'id_usuario');

    }

    public function getAuthIdentifierName(){
        return 'login'; //identifica o nome do objeto autenticado
    }
    public function getAuthIdentifier(){
        return $this->login; //retorna o identificador do usuário
    }
    public function getAuthPassword(){
        return $this->senha; //retorna a senha
    }

    //para opões de "lembrar de mim"
    public function getRememberToken(){

    }
    public function setRememberToken($value){

    }
    public function getRememberTokenName(){

    }

    public function setCpfAttribute($cpf){
        //retira todos os pontos e traços do cpf (para salvar no banco)
        $value = preg_replace('/[^0-9]/','',$cpf);

        //substitui pelo valor sem pontuação
        $this->attributes['cpf'] = $value;
    }
}
