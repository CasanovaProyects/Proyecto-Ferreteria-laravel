<?php

namespace App\Filament\Widgets;
use App\Models\Producto; 
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResumenTienda extends BaseWidget
{
     /** Intervalo de refresco automático (polling) */
    protected static ?string $pollingInterval = '60s';   // cada minuto

    /** Tarjetas que se muestran en el widget */
    protected function getStats(): array
    {
        $ventasHoy = \App\Models\Venta::whereDate('fecha', now()->toDateString())->count();
        $totalHoy = \App\Models\Venta::whereDate('fecha', now()->toDateString())->sum('total');
        $pedidosHoy = \App\Models\Pedido::whereDate('created_at', today())->count();
        return [
            Stat::make('Productos', Producto::count()),
            Stat::make('Stock total', Producto::sum('stock')),
            Stat::make('Ventas hoy', $ventasHoy)->description('Total vendido: $' . number_format($totalHoy, 2)),
            Stat::make('Pedidos hoy', $pedidosHoy),
        ];
    }
}
