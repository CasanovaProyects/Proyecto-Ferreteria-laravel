<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;

use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
        TextInput::make('nombre')->required(),
        TextInput::make('sku')->unique()->required(),
        Select::make('categoria_id')
            ->relationship('categoria', 'nombre')
            ->searchable()
            ->required(),
        TextInput::make('precio_compra')->numeric()->prefix('$'),
        TextInput::make('precio_venta')->numeric()->prefix('$')->required(),
        TextInput::make('stock')->numeric()->minValue(0)->required(),
        FileUpload::make('foto')          // ← subida de imagen
            ->directory('productos')
            ->image()
            ->maxSize(1024),              // 1 MB
        Toggle::make('publicado'),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->label('Nombre')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('sku')->label('SKU')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('categoria.nombre')->label('Categoría')->sortable(),
                Tables\Columns\TextColumn::make('precio_venta')->label('Precio Venta')->money('COP', true)->sortable(),
                Tables\Columns\TextColumn::make('stock')->label('Stock')->sortable(),
                Tables\Columns\IconColumn::make('publicado')->boolean()->label('Publicado'),
                Tables\Columns\TextColumn::make('created_at')->label('Creado')->dateTime('d/m/Y')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
