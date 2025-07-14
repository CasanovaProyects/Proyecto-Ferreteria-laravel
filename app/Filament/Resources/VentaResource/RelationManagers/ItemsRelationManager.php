<?php

namespace App\Filament\Resources\VentaResource\RelationManagers;

use App\Models\VentaItem;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\RelationManagers\RelationManagerConfiguration;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Select::make('producto_id')
                ->relationship('producto', 'nombre')
                ->label('Producto')
                ->searchable()
                ->required(),
            TextInput::make('cantidad')->numeric()->minValue(1)->required(),
            TextInput::make('precio_unitario')->numeric()->prefix('$')->required(),
            TextInput::make('subtotal')->numeric()->prefix('$')->required(),
        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('producto.nombre')->label('Producto')->searchable()->sortable(),
            TextColumn::make('cantidad')->label('Cantidad')->sortable(),
            TextColumn::make('precio_unitario')->label('Precio Unitario')->money('MXN')->sortable(),
            TextColumn::make('subtotal')->label('Subtotal')->money('MXN')->sortable(),
        ])->actions([
            EditAction::make(),
        ]);
    }
}
