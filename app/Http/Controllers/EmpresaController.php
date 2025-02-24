<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);

        $servicos = $empresa->servicos;

        return view('empresas.show', compact('empresa', 'servicos'));
    }
    public function index(Request $request)
    {
        $empresas = Empresa::query();

        if ($request->filled('categoria_id')) {
            $empresas->whereHas('servicos', function ($query) use ($request) {
                $query->where('categoria_id', $request->categoria_id);
            });
        }

        if ($request->filled('valor')) {
            $empresas->where('valor', '<=', $request->valor);
        }

        if ($request->filled('tipo_cotacao')) {
            $empresas->where('tipo_cotacao', $request->tipo_cotacao);
        }

        $empresas = $empresas->get();

        return view('empresas.index', compact('empresas'));
    }
}
