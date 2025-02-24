<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Categoria;
use App\Models\Servico;
use App\Models\CategoriaServicos;
use App\Models\Empresa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $navigationIcon  = 'heroicon-m-wrench-screwdriver';
    protected static ?string $navigationGroup = 'Home';
    protected static ?string $navigationLabel = 'Serviços';
    protected static bool $canCreateAnother = false;
    protected static ?string $model = Servico::class;

    public $timestamps = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')->label('Nome do Serviço'),
                Forms\Components\Select::make('categoria_id')
                    ->label('Categoria')
                    ->options(Categoria::pluck('nome', 'id'))
                    ->required(),
                Forms\Components\TextInput::make('custo')->numeric()->inputMode('decimal')->label('Custo do Serviço'),
                Forms\Components\Select::make('empresa_id')
                ->label('Empresa')
                ->options(Empresa::all()->pluck('nome_fantasia', 'id'))
                ->required()
                ->searchable(),
                Forms\Components\TextArea::make('descricao')->label('Descrição'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->label('Nome do Serviço'),
                Tables\Columns\TextColumn::make('categoria.nome')->label('Categoria'),
                Tables\Columns\TextColumn::make('empresa.razao_social')->label('Empresa'),
                Tables\Columns\TextColumn::make('custo')->label('Custo')->money('BRL', true),
                Tables\Columns\TextColumn::make('descricao')->label('Descrição')->limit(50),
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
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return null;
    }
}
