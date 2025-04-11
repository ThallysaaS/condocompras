<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CotacaoResource\Pages;
use App\Models\Cotacao;
use App\Models\User;
use App\Models\Condominio;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class CotacaoResource extends Resource
{
    protected static ?string $model = Cotacao::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Cotações';
    protected static ?string $navigationLabel = 'Cotações';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Usuário')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),
                Select::make('condominio_id')
                    ->label('Condomínio')
                    ->options(Condominio::all()->pluck('nome_fantasia', 'id'))
                    ->nullable(),
                TextInput::make('data_cotacao')
                    ->label('Data da Cotação')
                    ->date()
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Em andamento' => 'Em andamento',
                        'Concluída' => 'Concluída',
                    ])
                    ->default('Em andamento')
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('data_cotacao')->label('Data da Cotação')->sortable(),
                BadgeColumn::make('status')->label('Status')->colors(['success', 'danger']),
                TextColumn::make('user.name')->label('Usuário'),
                TextColumn::make('condominio.nome')->label('Condomínio'),
                TextColumn::make('empresa.nome_fantasia')->label('Empresa'),
            ])
            ->filters([
                // Você pode adicionar filtros personalizados aqui
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCotacoes::route('/'),
            'create' => Pages\CreateCotacao::route('/create'),
            'edit' => Pages\EditCotacao::route('/{record}/edit'),
        ];
    }
}
