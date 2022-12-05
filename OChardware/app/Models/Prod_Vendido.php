<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prod_Vendido extends Model
{
    use HasFactory;
    protected $table = 'prod__vendidos';
    protected $fillable = ['valor_unitario','quantidade','id_pedido','id_produto'];
}
