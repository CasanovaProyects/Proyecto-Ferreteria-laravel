<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompraResource\Pages;
use App\Models\Compra;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompraResource extends Resource
{
    protected static ?string $model = Compra::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('folio')->required()->unique(),
            DatePicker::make('fecha')->required(),
            TextInput::make('total')->numeric()->prefix('$')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('folio')->label('Folio')->searchable(),
            TextColumn::make('fecha')->label('Fecha')->date('d/m/Y')->sortable(),
            TextColumn::make('total')->label('Total')->money('MXN')->sortable(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManager para items de compra (se puede agregar luego)
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompra::route('/'),
            'create' => Pages\CreateCompra::route('/create'),
            'edit' => Pages\EditCompra::route('/{record}/edit'),
        ];
    }
}
