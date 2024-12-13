<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Empresa;

class EmpresasCadastradasPorMes extends ChartWidget
{
    protected static ?string $heading = 'Cadastros Mensais de Empresas';

    protected function getData(): array
    {
        // Consultar os dados de cadastros por mês
        $data = Empresa::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year) // Filtrar para o ano atual
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Criar um array de rótulos (nomes dos meses)
        $months = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro',
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Cadastros de Empresas',
                    'data' => $data->pluck('count')->toArray(), // Quantidade de cadastros
                ],
            ],
            'labels' => $data->pluck('month')->map(fn($month) => $months[$month])->toArray(),
        ];
    }


    protected function getType(): string
    {
        return 'bar';
    }
}
