<?php

namespace App\Filament\Resources\CotacaoResource\Pages;

use App\Filament\Resources\CotacaoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCotacoes extends ListRecords
{
    protected static string $resource = CotacaoResource::class;
    protected static ?string $slug = 'cotacoes';

    protected function getActions(): array
    {
        return [
            Actions\Action::make('realizar_cotacao')
                ->label('Realizar Cotação')
                ->url(route('filament.admin.pages.realizar-cotacao'))
                ->icon('heroicon-o-plus'),
        ];
    }
}
