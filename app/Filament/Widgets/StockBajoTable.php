<?php

namespace App\Filament\Widgets;

use App\Models\Producto;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class StockBajoTable extends BaseWidget
{
    protected static ?string $pollingInterval = '60s';
    protected int $stockMinimo = 5; // Umbral de stock bajo

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\Relation|null
    {
        // Eager load 'categoria' para evitar N+1
        return Producto::with('categoria')
            ->where('stock', '<=', $this->stockMinimo)
            ->orderBy('stock', 'asc');
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('nombre')->label('Producto')->searchable(),
            TextColumn::make('sku')->label('SKU'),
            TextColumn::make('stock')->label('Stock')->sortable(),
            TextColumn::make('categoria.nombre')->label('Categoría'),
        ];
    }

    protected function getTableHeading(): ?string
    {
        return 'Productos con Stock Bajo';
    }
}
