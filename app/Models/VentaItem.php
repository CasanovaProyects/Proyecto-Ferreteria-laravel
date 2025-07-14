<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VentaItem extends Model
{
    protected static function booted()
    {
        static::created(function ($item) {
            $item->producto->decrement('stock', $item->cantidad);

            \App\Models\MovimientoInventario::create([
                'producto_id' => $item->producto_id,
                'tipo'        => 'SALIDA',
                'origin_type' => self::class,
                'origin_id'   => $item->id,
                'cantidad'    => $item->cantidad,
                'nota'        => 'Venta #' . $item->venta_id,
            ]);
        });
    }
    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
