<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function show($id)
    {
        // Recupera a empresa pelo ID
        $empresa = Empresa::findOrFail($id);

        // Carrega os serviços prestados pela empresa
        $servicos = $empresa->servicos;

        // Retorna a view com os detalhes da empresa e os serviços
        return view('empresas.show', compact('empresa', 'servicos'));
    }
    public function index(Request $request)
    {
        // Inicia a consulta para buscar as empresas
        $empresas = Empresa::query();

        // Filtra as empresas de acordo com os parâmetros fornecidos no formulário
        if ($request->filled('categoria_id')) {
            $empresas->whereHas('servicos', function ($query) use ($request) {
                $query->where('categoria_id', $request->categoria_id);
            });
        }

        if ($request->filled('valor')) {
            // Filtra empresas com base no valor, se necessário
            $empresas->where('valor', '<=', $request->valor);
        }

        if ($request->filled('tipo_cotacao')) {
            // Filtra empresas com base no tipo de cotação, se necessário
            $empresas->where('tipo_cotacao', $request->tipo_cotacao);
        }

        // Recupera as empresas filtradas
        $empresas = $empresas->get();

        // Passa as empresas para a view
        return view('empresas.index', compact('empresas'));
    }
}