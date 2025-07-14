<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimientoInventarioResource\Pages;
use App\Models\MovimientoInventario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovimientoInventarioResource extends Resource
{
    protected static ?string $model = MovimientoInventario::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-trending-down';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('producto_id')->relationship('producto', 'nombre')->required(),
            TextInput::make('tipo')->disabled(),
            TextInput::make('cantidad')->numeric()->required()->disabled(),
            TextInput::make('nota')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('producto.nombre')->label('Producto')->searchable(),
            TextColumn::make('tipo')->label('Tipo'),
            TextColumn::make('cantidad')->label('Cantidad'),
            TextColumn::make('nota')->label('Nota'),
            TextColumn::make('created_at')->label('Fecha')->dateTime('d/m/Y H:i'),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovimientoInventario::route('/'),
        ];
    }
}
