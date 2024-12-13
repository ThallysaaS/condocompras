<?php

namespace App\Filament\Resources\CondominioResource\Pages;

use App\Filament\Resources\CondominioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCondominio extends EditRecord
{
    protected static string $resource = CondominioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
