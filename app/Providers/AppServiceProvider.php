<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use App\Filament\Resources\CotacaoResource\Pages\RealizarCotacao;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Filament::registerPages([
            'realizar-cotacao' => RealizarCotacao::route('/realizar-cotacao'),
        ]);
    }
}
