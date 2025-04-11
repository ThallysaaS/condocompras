<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCotacao extends Model
{
    use HasFactory;
    protected $table = 'itens_cotacoes';

    protected $fillable = [
        'data',
        'produto_id',
        'servico_id',
        'condominio_id',
        'tipo',
        'status',
    ];

    public function cotacao()
    {
        return $this->belongsTo(Cotacao::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
