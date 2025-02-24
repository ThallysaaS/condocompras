<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpresaResource\Pages;
use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\CategoriaServicos;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Http;

class EmpresaResource extends Resource
{
    protected static ?string $model = Empresa::class;
    protected static ?string $navigationLabel = 'Empresa';
    protected static ?string $navigationGroup = 'Gerenciamento';
    protected static ?string $navigationIcon = 'carbon-enterprise';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('cnpj')
                    ->label('CNPJ')
                    ->placeholder('Digite o CNPJ sem pontuação')
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => self::buscarEmpresa($state, $set)),
                Forms\Components\TextInput::make('nome_fantasia')
                    ->label('Nome Fantasia')
                    ->required(),
                Forms\Components\TextInput::make('razao_social')
                    ->label('Razão Social')
                    ->required(),
                Forms\Components\TextInput::make('atividade_principal')
                    ->label('Atividade Principal')
                    ->required(),
                Forms\Components\TextInput::make('telefone')
                    ->label('Telefone')
                    ->required(),
                Forms\Components\TextInput::make('logradouro')
                    ->label('Logradouro')
                    ->required(),
                Forms\Components\TextInput::make('numero')
                    ->label('Número'),
                Forms\Components\TextInput::make('complemento')
                    ->label('Complemento')
                    ->required(),
                Forms\Components\TextInput::make('bairro')
                    ->label('Bairro')
                    ->required(),
                Forms\Components\TextInput::make('municipio')
                    ->label('Município')
                    ->required(),
                Forms\Components\TextInput::make('uf')
                    ->label('UF')
                    ->required(),
                Forms\Components\TextInput::make('cep')
                    ->label('CEP')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('E-mail')
                    ->required(),
                Forms\Components\Select::make('tipo')
                    ->label('Tipo')
                    ->required()
                    ->options([
                        'Fornecedor' => 'Fornecedor',
                        'Prestador de Serviço' => 'Prestador de Serviço',
                        'Ambos' => 'Ambos',]),
                Forms\Components\DateTimePicker::make('data_do_cadastro')
                    ->label('Data do cadastro')
                    ->default(now())
                    ->required()
                    ->displayFormat('d/m/Y')
                    ->readOnly(),
            ]);
    }

    public static function buscarEmpresa($cnpj, callable $set)
    {
        if (strlen($cnpj) === 14) {
            $url = "https://receitaws.com.br/v1/cnpj/{$cnpj}";

            try {
                $response = Http::get($url);
                $dados = $response->json();

                if ($dados && isset($dados['status']) && $dados['status'] === 'OK') {
                    $atividadePrincipal = $dados['atividade_principal'][0]['text'] ?? '';
                    $set('nome_fantasia', $dados['fantasia'] ?? $dados['nome']);
                    $set('razao_social', $dados['nome']);
                    $set('atividade_principal', $atividadePrincipal);
                    $set('telefone', $dados['telefone']);
                    $set('logradouro', $dados['logradouro']);
                    $set('numero', $dados['numero']);
                    $set('complemento', $dados['complemento']);
                    $set('bairro', $dados['bairro']);
                    $set('municipio', $dados['municipio']);
                    $set('uf', $dados['uf']);
                    $set('cep', $dados['cep']);
                    $set('email', $dados['email']);

                    $categoriaExistente = Categoria::where('nome', $atividadePrincipal)->first();
                    if (!$categoriaExistente && $atividadePrincipal) {
                        Categoria::create([
                            'nome' => $atividadePrincipal,
                        ]);
                    }
                }
            } catch (\Exception $e) {

            }
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cnpj')->label('CNPJ'),
                Tables\Columns\TextColumn::make('nome_fantasia')->label('Nome da empresa'),
                Tables\Columns\TextColumn::make('razao_social')->label('Razão Social'),
                Tables\Columns\TextColumn::make('atividade_principal')->label('Atividade Principal'),
                Tables\Columns\TextColumn::make('telefone')->label('Telefone'),
                Tables\Columns\TextColumn::make('logradouro')->label('Logradouro'),
                Tables\Columns\TextColumn::make('numero')->label('N.º'),
                Tables\Columns\TextColumn::make('complemento')->label('Complemento'),
                Tables\Columns\TextColumn::make('bairro')->label('Bairro'),
                Tables\Columns\TextColumn::make('municipio')->label('Município'),
                Tables\Columns\TextColumn::make('uf')->label('UF'),
                Tables\Columns\TextColumn::make('cep')->label('CEP'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('data_do_cadastro')->label('Data do cadastro'),
            ])
            ->filters([])
            ->actions([ Tables\Actions\EditAction::make() ])
            ->bulkActions([ Tables\Actions\BulkActionGroup::make([ Tables\Actions\DeleteBulkAction::make() ]) ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmpresas::route('/'),
            'create' => Pages\CreateEmpresa::route('/create'),
            'edit' => Pages\EditEmpresa::route('/{record}/edit'),
        ];
    }

    public static function getNavigation(): array
{
    return [
        'label' => static::$navigationLabel ?? 'Empresas',
        'icon' => static::$navigationIcon ?? 'heroicon-o-building',
        'group' => static::$navigationGroup ?? 'Gerenciamento',
        'url' => static::getUrl('index'),
    ];
}
}
