<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_sindico',
        'nome_fantasia',
        'telefone',
        'email',
        'uf',
        'cnpj',
        'logradouro',
        'complemento_do_endereco',     
        'cep',
        'bairro',
        'data_do_cadastro',
    ];
}
