<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use SoftDeletes;

    protected $fillable = ['folio', 'proveedor_id', 'total', 'fecha'];

    public function items() { return $this->hasMany(CompraItem::class); }

    protected static function booted()
    {
        static::saving(function ($c) {
            $c->total = $c->items->sum(fn ($i) => $i->cantidad * $i->precio_unitario);
        });
    }
}
