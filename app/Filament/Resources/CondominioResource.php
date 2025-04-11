<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CondominioResource\Pages;
use App\Models\Condominio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use App\Filament\Resources\CondominioResource\Pages\CreateCondominio;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class CondominioResource extends Resource
{
    protected static ?string $model = Condominio::class;

    protected static ?string $navigationIcon = 'hugeicons-city-01';
    protected static ?string $navigationGroup = 'Gerenciamento';
    protected static ?string $pluralModelLabel = 'Condominios';
    protected static ?string $modelLabel = 'condominios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome_fantasia')
                    ->label('Nome do Condomínio')
                    ->required(),
                Forms\Components\TextInput::make('cep')
                    ->label('CEP')
                    ->required()
                    ->extraInputAttributes(['maxlength' => 8])
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $cep = preg_replace('/\D/', '', trim($state));
                        (new CreateCondominio())->buscarCep($cep, $set);
                    }),
                Forms\Components\TextInput::make('logradouro')->label('Logradouro'),
                Forms\Components\TextInput::make('complemento_do_endereco')->label('Complemento'),
                Forms\Components\TextInput::make('bairro')->label('Bairro'),
                Forms\Components\TextInput::make('uf')->label('UF')->required(),
                Forms\Components\TextInput::make('cnpj')->label('CNPJ')->extraInputAttributes(['maxlength' => 14])->required(),
                Forms\Components\TextInput::make('email')->label('Email')->email()->required(),
                Forms\Components\TextInput::make('nome_sindico')->label('Síndico')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome_fantasia')->label('Nome do Condomínio'),
                TextColumn::make('cnpj')->label('CNPJ'),
                TextColumn::make('email')->label('email'),
                TextColumn::make('nome_sindico')->label('Síndico'),
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
            'index' => Pages\ListCondominios::route('/'),
            'create' => Pages\CreateCondominio::route('/create'),
            'edit' => Pages\EditCondominio::route('/{record}/edit'),
        ];
    }
}
