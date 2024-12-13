<?php

namespace App\Filament\Resources\CondominioResource\Pages;

use App\Filament\Resources\CondominioResource;
use Filament\Resources\Pages\CreateRecord;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Filament\Notifications\Notification;

class CreateCondominio extends CreateRecord
{
    protected static string $resource = CondominioResource::class;

    public function buscarCep($cep, callable $set)
    {
        // Valida o formato do CEP
        $validator = Validator::make(['cep' => $cep], [
            'cep' => 'required|digits:8',
        ]);

        if ($validator->fails()) {
            Notification::make()
                ->title('CEP inválido')
                ->body('Certifique-se de que o CEP tenha 8 dígitos.')
                ->danger()
                ->send();

            return;
        }

        // Faz a requisição à API
        $client = new Client();
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        try {
            $response = $client->request('GET', $url);
            $dados = json_decode($response->getBody(), true);

            if (!isset($dados['erro'])) {
                $this->form->fill([           
                    'logradouro' => $dados['logradouro'],     
                    'bairro' => $dados['bairro'],
                    'UF' => $dados['uf']
                ]);

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
                ->body('Erro ao conectar com a API. Tente novamente mais tarde.')
                ->danger()
                ->send();
        }
    }
}
