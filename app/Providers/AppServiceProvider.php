<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\NResource\Pages\RealizarCotacao;

class AdminServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::registerPages([
            'realizar-cotacao' => RealizarCotacao::route('/realizar-cotacao'),
        ]);
    }
}
