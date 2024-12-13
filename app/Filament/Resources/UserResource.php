<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Gerenciamento';
    protected static ?string $navigationLabel = 'Usuários';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nome do usuário'),
    
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('E-mail'),
    
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->label('Crie uma senha')
                    ->required(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                    ->visible(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),
    
                Forms\Components\Select::make('tipo_login')
                    ->required()
                    ->label('Selecione o tipo do usuário')
                    ->options([
                        '1' => 'Administrador',
                        '2' => 'Empresa',
                        '3' => 'Síndico',
                        '4' => 'Usuário',
                    ])
                    ->reactive(),
    
                Forms\Components\Select::make('tipo_empresa')
                    ->label('Selecione o tipo da empresa')
                    ->options([
                        'fornecedor' => 'Fornecedor',
                        'prestador' => 'Prestador de Serviços',
                        'ambos' => 'Ambos',
                    ])
                    ->visible(fn (callable $get) => $get('tipo_login') === '2'), // Exibe apenas se o tipo for Empresa
            ]);
    }
    
                                    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome do usuário'),
                Tables\Columns\TextColumn::make('email')->label('E-mail'),
                Tables\Columns\TextColumn::make('password'),
                Tables\Columns\TextColumn::make('tipo_login')->label('Tipo'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
