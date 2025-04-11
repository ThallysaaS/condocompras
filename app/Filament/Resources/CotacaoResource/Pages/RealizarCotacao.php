<?php

namespace App\Filament\Resources\CotacaoResource\Pages;

use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Cotacao;
use App\Models\Servico;
use App\Models\Produto;
use App\Models\ItemCotacao;
use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class RealizarCotacao extends Page implements HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'solar-tag-price-linear';
    protected static ?string $navigationLabel = 'Realizar Cotação';
    protected static ?string $navigationGroup = 'Cotações';
    protected static string $view = 'filament.resources.cotacoes.pages.realizar-cotacao';

    public $categoria_id;
    public $custo;
    public $empresas = null;
    public $selectedServicos = []; // Array para armazenar os serviços selecionados
    public $selectedProdutos = []; // Array para armazenar os produtos selecionados

    protected function getFormSchema(): array
    {
        return [
            Select::make('categoria_id')
                ->label('Deseja realizar cotação de qual serviço ou produto?')
                ->options(Categoria::pluck('nome', 'id')->toArray())
                ->required(),
            TextInput::make('custo')
                ->label('Valor Estipulado')
                ->numeric()
                ->required(),
        ];
    }

    public function submitForm()
    {
        $form_data = $this->form->getState();

        if (empty($form_data['categoria_id']) || empty($form_data['custo'])) {
            Notification::make()
                ->title('Erro')
                ->body('Preencha todos os campos antes de prosseguir.')
                ->warning()
                ->send();
            return;
        }

        // Carregar empresas com serviços e produtos filtrados
        $this->empresas = Empresa::whereHas('servicos', function ($query) use ($form_data) {
                $query->where('categoria_id', $form_data['categoria_id'])
                      ->where('custo', '<=', $form_data['custo']);
            })
            ->orWhereHas('produtos', function ($query) use ($form_data) {
                $query->where('categoria_id', $form_data['categoria_id'])
                      ->where('custo', '<=', $form_data['custo']);
            })
            ->with([
                'servicos' => function ($query) use ($form_data) {
                    $query->where('categoria_id', $form_data['categoria_id'])
                          ->where('custo', '<=', $form_data['custo']);
                },
                'produtos' => function ($query) use ($form_data) {
                    $query->where('categoria_id', $form_data['categoria_id'])
                          ->where('custo', '<=', $form_data['custo']);
                }
            ])
            ->get();

        // Verificar se encontrou empresas, serviços ou produtos
        if ($this->empresas->isEmpty()) {
            Notification::make()
                ->title('Nenhum Serviço ou Produto Encontrado')
                ->body('Não foram encontrados serviços ou produtos com os critérios fornecidos.')
                ->warning()
                ->send();
        } else {
            Notification::make()
                ->title('Serviços e Produtos Encontrados')
                ->body('Encontramos serviços e/ou produtos que atendem aos critérios fornecidos.')
                ->success()
                ->send();
        }
    }


    public function salvarCotacao()
    {
        if (empty($this->selectedServicos) && empty($this->selectedProdutos)) {
            Notification::make()
                ->title('Erro')
                ->body('Selecione pelo menos um serviço ou produto para realizar a cotação.')
                ->danger()
                ->send();
            return;
        }

        // Criar a cotação com empresa vinculada
        $cotacao = Cotacao::create([
            'data_cotacao' => now(),
            'user_id' => Auth::id(),
            'condominio_id' => Auth::user()->condominio_id ?? null,
            'empresa_id' => null,  // Associamos à empresa depois conforme os itens selecionados
            'tipo' => 0,
            'status' => 'Em andamento',
        ]);

        // Gerar um identificador único para a cotação
        $cotacao_id = 'COT-' . strtoupper(uniqid());

        // Adicionar os serviços selecionados na cotação
        foreach ($this->selectedServicos as $servico_id) {
            $servico = Servico::find($servico_id);
            if ($servico) {
                ItemCotacao::create([
                    'data' => now(),
                    'produto_id' => null,
                    'servico_id' => $servico->id,
                    'cotacao_id' => $cotacao_id,
                    'condominio_id' => Auth::user()->condominio_id ?? null,
                    'tipo' => 0,
                    'status' => 'Em andamento',
                ]);
            }
        }

        // Adicionar os produtos selecionados na cotação
        foreach ($this->selectedProdutos as $produto_id) {
            $produto = Produto::find($produto_id);
            if ($produto) {
                ItemCotacao::create([
                    'data' => now(),
                    'produto_id' => $produto->id,
                    'servico_id' => null,
                    'cotacao_id' => $cotacao_id,
                    'condominio_id' => Auth::user()->condominio_id ?? null,
                    'tipo' => 1,  // 1 para produtos
                    'status' => 'Em andamento',
                ]);
            }
        }

        Notification::make()
            ->title('Cotação Realizada com Sucesso')
            ->body('Sua cotação foi salva e enviada para avaliação das empresas.')
            ->success()
            ->send();

        $this->reset(['empresas', 'selectedServicos', 'selectedProdutos']);
    }
}
