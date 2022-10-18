<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prod_Carrinho extends Model
{
    use HasFactory;
    protected $table = 'prod__carrinhos';
    protected $fillable = ['quantidade','id_produto','id_usuario'];

    public function produtos(){
        return $this->belongsTo(Produto::class,'id_produto');
    }

}
