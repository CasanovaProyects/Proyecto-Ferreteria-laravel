<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class TiendaSettings extends Settings
{
    /** Información general */
    public string $nombre;
    public string $telefono;
    public string $email;
    public string $direccion;

    /** Apariencia */
    public ?string $logo_path;
    public string $color_primario;

    /** Impuestos */
    public bool   $usa_impuesto;
    public string $impuesto_nombre;
    public float  $impuesto_tasa;   // 0.16 → 16 %

    public static function group(): string
    {
        return 'tienda';
    }
}
