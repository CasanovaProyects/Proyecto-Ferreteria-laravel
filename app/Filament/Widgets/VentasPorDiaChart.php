<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;
use App\Models\Venta;

class VentasPorDiaChart extends Widget
{
    protected static string $view = 'filament.widgets.ventas-por-dia-chart';
    protected static ?int $sort = 2;

    public function getData(): array
    {
        $dias = collect(range(0, 29))->map(function ($i) {
            return now()->subDays(29 - $i)->format('Y-m-d');
        });

        $ventas = Venta::whereBetween('fecha', [now()->subDays(29)->startOfDay(), now()->endOfDay()])
            ->get()
            ->groupBy(fn($venta) => $venta->fecha->format('Y-m-d'));

        $labels = $dias->toArray();
        $data = $dias->map(fn($dia) => isset($ventas[$dia]) ? $ventas[$dia]->count() : 0)->toArray();
        $totales = $dias->map(fn($dia) => isset($ventas[$dia]) ? $ventas[$dia]->sum('total') : 0)->toArray();

        return [
            'labels' => $labels,
            'data' => $data,
            'totales' => $totales,
        ];
    }
}
