<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = ['nome','id_categoria','id_marca','preco','descricao','foto','largura','altura','peso','comprimento','quantidade'];

    public function prods_carrinho(){

        return $this->hasMany(Prod_Carrinho::class, 'id_produto');

    }
}
