<?php

namespace App\Filament\Resources\CotacaoResource\Pages;

use App\Filament\Resources\CotacaoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCotacao extends CreateRecord
{
    protected static string $resource = CotacaoResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
