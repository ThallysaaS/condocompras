<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_cotacao',
        'user_id',
        'condominio_id',
        'tipo',
        'status',
    ];

    public function itens()
    {
        return $this->hasMany(ItemCotacao::class);
    }
}