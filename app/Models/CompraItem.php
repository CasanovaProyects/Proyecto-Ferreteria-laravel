<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraItem extends Model
{
    protected $fillable = ['compra_id', 'producto_id', 'cantidad', 'precio_unitario'];

    public function compra()   { return $this->belongsTo(Compra::class); }
    public function producto() { return $this->belongsTo(Producto::class); }

    protected static function booted()
    {
        static::created(function ($item) {
            $item->producto->increment('stock', $item->cantidad);

            \App\Models\MovimientoInventario::create([
                'producto_id' => $item->producto_id,
                'tipo'        => 'ENTRADA',
                'origin_type' => self::class,
                'origin_id'   => $item->id,
                'cantidad'    => $item->cantidad,
                'nota'        => 'Compra ' . $item->compra->folio,
            ]);
        });
    }
}
