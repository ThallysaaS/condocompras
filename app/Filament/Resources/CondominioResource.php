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
                    ->label('Nome do Condominio')
                    ->required(),
                Forms\Components\TextInput::make('cep')
                    ->label('CEP')
                    ->required()
                    ->extraInputAttributes(['maxlength' => 8])
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        // Instancie a classe CreateCondominio para chamar buscarCep
                        (new CreateCondominio())->buscarCep($state, $set);
                    }),
                Forms\Components\TextInput::make('logradouro')->label('Logradouro'),
                Forms\Components\TextInput::make('complemento_do_endereco')->label('Complemento'),
                Forms\Components\TextInput::make('bairro')->label('Bairro'),
                Forms\Components\TextInput::make('UF')->label('UF'),
                Forms\Components\TextInput::make('cnpj')->label('CNPJ')->required(),
                Forms\Components\TextInput::make('email')->label('Email')->email(),
                Forms\Components\TextInput::make('nome_sindico')->label('Síndico'),
                // subsíndico, telefone condominio, CPF Síndico, endereço sindico, email sindico, telefone, dt nascimento
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
