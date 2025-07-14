<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre', 'telefono', 'email', 'direccion'];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
