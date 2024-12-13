<?php

namespace App\Filament\Resources\EmpresaResource\Pages;

use App\Filament\Resources\EmpresaResource;
use Filament\Resources\Pages\CreateRecord;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class CreateEmpresa extends CreateRecord
{
    protected static string $resource = EmpresaResource::class;

    public function buscarEmpresa()
    {
        $cnpj = $this->form->getState()['cnpj'];

        // Validação básica do CNPJ
        $validator = Validator::make(['cnpj' => $cnpj], [
            'cnpj' => 'required|digits:14', 
        ]);

        if ($validator->fails()) {
            $this->notify('danger', 'CNPJ inválido. Certifique-se de que ele tenha 14 dígitos.');
            return;
        }

        
        $client = new Client();
        $url = "https://www.receitaws.com.br/v1/cnpj/{$cnpj}";

        try {
            
            $response = $client->request('GET', $url);

            
            $dados = json_decode($response->getBody(), true);

           
            if (isset($dados['status']) && $dados['status'] === 'OK') {
                
                $this->form->fill([
                    'nome_fantasia' => $dados['nome'],
                    'logradouro' => $dados['logradouro'] . ', ' . $dados['numero'],
                    'telefone' => $dados['telefone'],
                    'bairro' => $dados['bairro'],
                    'municipio' => $dados['municipio'],
                    'uf' => $dados['uf'],
                    'cep' => $dados['cep'],
                    'cnae_principal' => $dados['atividade_principal'][0]['code'],
                ]);

                
                $this->notify('success', 'Dados da empresa recuperados com sucesso!');
            } else {
                $this->notify('danger', 'Erro ao buscar informações da empresa. Verifique o CNPJ.');
            }
        } catch (\Exception $e) {
            
            $this->notify('danger', 'Erro ao conectar com a API. Tente novamente mais tarde.');
        }
    }
}