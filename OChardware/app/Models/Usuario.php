<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable; //para autenticação

class Usuario extends Model implements Authenticatable
{
    use HasFactory;
    protected $table = 'usuarios';
    protected $fillable = ['nome','cpf','email','senha','tipo'];

    public function getAuthIdentifierName(){
        return 'email'; //identifica o nome do objeto autenticado
    }
    public function getAuthIdentifier(){
        return $this->email; //retorna o identificador do usuário
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
