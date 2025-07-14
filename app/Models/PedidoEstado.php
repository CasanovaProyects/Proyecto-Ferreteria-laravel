<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoEstado extends Model
{
    protected $fillable = ['pedido_id', 'estatus', 'nota', 'fecha'];

    public function pedido() { return $this->belongsTo(Pedido::class); }
}
