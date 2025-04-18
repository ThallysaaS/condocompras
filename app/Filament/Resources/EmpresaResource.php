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
                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('cnpj')
                            ->label('CNPJ')
                            ->placeholder('Digite o CNPJ sem pontuação')
                            ->required(),

                        Forms\Components\Actions::make([
                            Forms\Components\Actions\Action::make('Pesquisar')
                                ->label('Pesquisar CNPJ')
                                ->icon('heroicon-m-magnifying-glass')
                                ->action(fn (callable $get, callable $set) => self::buscarEmpresa($get('cnpj'), $set))
                                ->color('primary')
                        ])
                        ->columns(1),
                    ]),
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
                        'Ambos' => 'Ambos',
                    ])
                    ->default('Ambos'),
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
        $cnpj = preg_replace('/\D/', '', $cnpj); // Remove qualquer caractere não numérico

        if (strlen($cnpj) === 14) {
            $url = "https://receitaws.com.br/v1/cnpj/{$cnpj}";

            try {
                // Desabilita a verificação SSL
                $response = Http::withoutVerifying()->get($url);

                if ($response->status() === 429) {
                    throw new \Exception('Limite de consultas excedido. Tente novamente mais tarde.');
                }

                if ($response->status() === 504) {
                    throw new \Exception('Timeout na API da ReceitaWS. Tente novamente mais tarde.');
                }

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
                    $set('tipo', $dados['tipo'] ?? 'Ambos');

                    $categoriaExistente = Categoria::where('nome', $atividadePrincipal)->first();
                    if (!$categoriaExistente && $atividadePrincipal) {
                        Categoria::create([
                            'nome' => $atividadePrincipal,
                        ]);
                    }

                    \Filament\Notifications\Notification::make()
                        ->title('Empresa encontrada!')
                        ->body('Os dados foram preenchidos automaticamente.')
                        ->success()
                        ->send();
                } else {
                    throw new \Exception('CNPJ não encontrado ou dados indisponíveis.');
                }
            } catch (\Exception $e) {
                \Log::error('Erro na busca de CNPJ: ' . $e->getMessage());
                \Filament\Notifications\Notification::make()
                    ->title('Erro ao buscar CNPJ')
                    ->body($e->getMessage())
                    ->danger()
                    ->send();
            }
        } else {
            \Filament\Notifications\Notification::make()
                ->title('CNPJ inválido')
                ->body('Digite um CNPJ válido com 14 números.')
                ->warning()
                ->send();
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
