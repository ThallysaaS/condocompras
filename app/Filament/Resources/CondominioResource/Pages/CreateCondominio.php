<?php

namespace App\Filament\Resources\CondominioResource\Pages;

use App\Filament\Resources\CondominioResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Filament\Notifications\Notification;
use Filament\Forms;
use Illuminate\Support\Facades\Log;

class CreateCondominio extends CreateRecord
{
    protected static string $resource = CondominioResource::class;

    public function buscarCep($cep, callable $set)
    {
        // Limpar espaços e caracteres não numéricos
        $cep = preg_replace('/\D/', '', trim($cep));

        // Log para depuração
        Log::info('Valor do CEP após limpeza: ' . $cep);

        // Garantindo que o CEP tenha exatamente 8 dígitos
        $validator = Validator::make(['cep' => $cep], [
            'cep' => 'required|digits:8',
        ]);

        if ($validator->fails()) {
            Log::error('Falha na validação do CEP: ' . $cep); // Logar erro de validação

            Notification::make()
                ->title('CEP inválido')
                ->body('Certifique-se de que o CEP tenha 8 dígitos.')
                ->danger()
                ->send();
            return;
        }

        // Construindo a URL da requisição
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        try {
            // Desabilita a verificação SSL e evita redirecionamentos
            $response = Http::withoutVerifying()->withoutRedirecting()->get($url);

            // Verificando se a requisição falhou
            if ($response->failed()) {
                throw new \Exception('Falha na requisição ao ViaCEP.');
            }

            // Decodificando a resposta JSON
            $dados = $response->json();

            // Verificando se o retorno não tem erro
            if (!isset($dados['erro'])) {
                // Preenchendo os campos automaticamente no formulário
                $set('logradouro', $dados['logradouro'] ?? '');
                $set('bairro', $dados['bairro'] ?? '');
                $set('uf', $dados['uf'] ?? '');

                Notification::make()
                    ->title('Sucesso')
                    ->body('Endereço recuperado com sucesso!')
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('CEP não encontrado')
                    ->body('Verifique o número do CEP informado.')
                    ->danger()
                    ->send();
            }
        } catch (\Exception $e) {
            Notification::make()
                ->title('Erro ao conectar')
                ->body('Erro ao conectar com a API. Verifique sua conexão com a internet.')
                ->danger()
                ->send();
        }
    }
}
