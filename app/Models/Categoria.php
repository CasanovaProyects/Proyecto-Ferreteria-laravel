<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre', 'slug', 'descripcion'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
