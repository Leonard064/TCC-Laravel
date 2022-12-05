<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    protected $fillable = ['total_pedido','frete_tipo','frete_valor','pagamento_tipo','status','id_usuario','id_endereco'];
}
