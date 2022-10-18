<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = ['nome','categoria','preco','descricao','foto'];

    public function prods_carrinho(){

        return $this->hasMany(Prod_Carrinho::class, 'id_produto');

    }
}
