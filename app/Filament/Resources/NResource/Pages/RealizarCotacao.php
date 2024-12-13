<?php

namespace App\Filament\Resources\NResource\Pages;

use App\Models\Categoria;
use App\Models\Empresa;
use Filament\Pages\Page;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;

class RealizarCotacao extends Page implements HasForms
{
    use InteractsWithActions;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'solar-tag-price-linear';
    protected static ?string $navigationLabel = 'Realizar Cotação';
    protected static ?string $navigationGroup = 'Cotações';
    protected static string $view = 'filament.resources.n-resource.pages.realizar-cotacao';

    public $categoria_id;
    public $custo;
    public $empresas = null;

    protected function getFormSchema(): array
    {
        return [
            Select::make('categoria_id')
                ->label('Deseja realizar cotação de qual serviço?')
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
    
        // Carregar serviços relacionados à categoria e custo máximo
        $this->empresas = Empresa::whereHas('servicos', function ($query) use ($form_data) {
            $query->where('categoria_id', $form_data['categoria_id'])
                  ->where('custo', '<=', $form_data['custo']);
        })->with(['servicos' => function ($query) use ($form_data) {
            $query->where('categoria_id', $form_data['categoria_id'])
                  ->where('custo', '<=', $form_data['custo']);
        }])->get();
    
        if ($this->empresas->isEmpty()) {
            Notification::make()
                ->title('Nenhum Serviço Encontrado')
                ->body('Não foram encontrados serviços com os critérios fornecidos.')
                ->warning()
                ->send();
        } else {
            Notification::make()
                ->title('Serviços Encontrados')
                ->body('Encontramos serviços que atendem aos critérios fornecidos.')
                ->success()
                ->send();
        }
    }
}
