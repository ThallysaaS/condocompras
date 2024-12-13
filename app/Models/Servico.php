<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'nome',
        'descricao',
        'categoria_id',
        'empresa_id',
        'custo',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
