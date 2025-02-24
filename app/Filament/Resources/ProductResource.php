<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Empresa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Produto::class;
    protected static ?string $navigationGroup = 'Home';
    protected static ?string $navigationIcon  = 'carbon-ibm-data-product-exchange';
    protected static ?string $navigationLabel = 'Produtos';

    public static function getNavigation(): NavigationItem
    {
        return NavigationItem::make('Produtos')
            ->icon('heroicon-o-cube');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')->label('Nome do Produto'),
                Forms\Components\Select::make('categoria_id')
                    ->label('Categoria')
                    ->options(Categoria::pluck('nome', 'id'))
                    ->required(),
                Forms\Components\Select::make('empresa_id')
                    ->label('Empresa')
                    ->options(Empresa::pluck('nome_fantasia', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('custo')->numeric()->inputMode('decimal')->label('Custo'),
                Forms\Components\TextArea::make('descricao')->label('Descrição'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->label('Nome do Produto'),
                Tables\Columns\TextColumn::make('categoria.nome')->label('Categoria'),
                Tables\Columns\TextColumn::make('empresa.razao_social')->label('Empresa'),
                Tables\Columns\TextColumn::make('custo')->label('Custo')->money('BRL', true),
                Tables\Columns\TextColumn::make('descricao')->label('Descrição')->limit(50),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('empresa')
                    ->label('Empresa')
                    ->options(Empresa::pluck('nome_fantasia', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
