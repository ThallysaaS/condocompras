<?php

namespace App\Filament\Resources\CondominioResource\Pages;

use App\Filament\Resources\CondominioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCondominios extends ListRecords
{
    protected static string $resource = CondominioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
