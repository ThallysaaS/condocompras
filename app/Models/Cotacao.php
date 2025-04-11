<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    use HasFactory;
    protected $table = 'cotacoes';

    protected $fillable = [
        'data_cotacao',
        'user_id',
        'condominio_id',
        'tipo',
        'status',
        'empresa_id',
    ];

    public function itens()
    {
        return $this->hasMany(ItemCotacao::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
