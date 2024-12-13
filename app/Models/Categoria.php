<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $fillable = [
        'nome', 
        'tipo'
    ];

    public function categoriaServico()
    {
        return $this->hasMany(Servico::class, 'categoria_sid');
    }

    public function categoriaProduto()
    {
        return $this->hasMany(Produto::class, 'categoria_pid');
    }
}
