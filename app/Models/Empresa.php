<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'cnpj',
        'abertura',
        'situacao',
        'numero',
        'razao_social',
        'nome_fantasia',
        'cep',
        'logradouro',
        'bairro',
        'municipio',
        'uf',
        'complemento',
        'telefone',
        'email',
        'atividade_principal',
        'atividade_secundaria',
        'data_do_cadastro',
        'data_de_desativacao',
    ];

    public static function validateCnpjUnique($cnpj)
    {
        return DB::table('empresas')->where('cnpj', $cnpj)->exists();
    }

    public function servicos()
    {
        return $this->hasMany(Servico::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    // Evento para criar a categoria quando a empresa for criada
    protected static function booted()
    {
        static::created(function ($empresa) {
            // Verifique se a empresa tem uma atividade principal
            if ($empresa->atividade_principal) {
                // Verifique se a categoria com o nome da atividade principal já existe
                $categoria = DB::table('categorias')->where('nome', $empresa->atividade_principal)->first();

                // Se não existir, cria a nova categoria
                if (!$categoria) {
                    DB::table('categorias')->insert([
                        'nome' => $empresa->atividade_principal,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });
    }
}
