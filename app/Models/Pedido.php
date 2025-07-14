<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use SoftDeletes;

    protected $fillable = ['cliente_id', 'total', 'estatus_actual'];

    public function cliente()  { return $this->belongsTo(Cliente::class); }
    public function items()    { return $this->hasMany(PedidoItem::class); }
    public function estados()  { return $this->hasMany(PedidoEstado::class); }
    public function venta()    { return $this->hasOne(Venta::class); }

    protected static function booted()
    {
        static::saving(function ($p) {
            $p->total = $p->items->sum(fn ($i) => $i->cantidad * $i->precio_unitario);
        });
    }

    public function cambiarEstatus(string $nuevo, ?string $nota = null): void
    {
        $this->update(['estatus_actual' => $nuevo]);
        $this->estados()->create([
            'estatus' => $nuevo,
            'nota'    => $nota,
        ]);
        // Si entregado, genera venta si no existe
        if ($nuevo === 'ENTREGADO' && !$this->venta) {
            $venta = $this->venta()->create([
                'cliente_id'  => $this->cliente_id,
                'empleado_id' => auth()->id() ?? 1,
                'total'       => 0,
                'fecha'       => today(),
            ]);
            foreach ($this->items as $item) {
                $venta->items()->create([
                    'producto_id'     => $item->producto_id,
                    'cantidad'        => $item->cantidad,
                    'precio_unitario' => $item->precio_unitario,
                ]);
            }
        }
    }
}
