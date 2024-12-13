<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Produto;

class QuantidadeProdutoPorCategoria extends ChartWidget
{
    protected static ?string $heading = 'Relatório de Produtos por Categoria';

    protected function getData(): array
    {
        // Consulta para obter a quantidade de produtos por categoria
        $data = Produto::selectRaw('categoria_id as categoria_id, COUNT(*) as count')
            ->groupBy('categoria_id')
            ->with('categoria') // Certifique-se de que o relacionamento está configurado no modelo Produto
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Quantidade de Produtos',
                    'data' => $data->pluck('count')->toArray(),
                ],
            ],
            'labels' => $data->map(fn($item) => $item->categoria?->nome ?? 'Sem Categoria')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
