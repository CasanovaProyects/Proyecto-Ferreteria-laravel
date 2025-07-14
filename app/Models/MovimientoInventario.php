<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    protected $table = 'movimientos_inventario';
    protected $fillable = [
        'producto_id', 'tipo', 'origin_type', 'origin_id', 'cantidad', 'nota', 'fecha',
    ];

    public function producto() { return $this->belongsTo(Producto::class); }
    public function origin()   { return $this->morphTo(); }
}
