<?php

namespace App\Filament\Resources\CotacaoResource\Pages;

use App\Models\Cotacao;
use Filament\Pages\Page;

class Cotacoes extends Page
{
    protected static ?string $navigationLabel = 'Andamento das Cotações';
    protected static ?string $slug = 'cotacoes';
    protected static ?string $title = 'Andamento das Cotações';
    protected static string $view = 'filament.app.views.resources.cotacoes.pages.cotacoes';

    public Cotacao $cotacao;

    public function mount(int $cotacao_id): void
    {
        $this->cotacao = Cotacao::findOrFail($cotacao_id);
    }
}
