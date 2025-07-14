<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'sku',
        'categoria_id',
        'precio_compra',
        'precio_venta',
        'stock',
        'foto',
        'publicado',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function ventaItems()
    {
        return $this->hasMany(VentaItem::class);
    }
}

