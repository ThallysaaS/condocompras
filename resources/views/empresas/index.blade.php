@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-semibold text-gray-900">Empresas Encontradas</h1>

        <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
            @if($empresas->isEmpty())
                <p class="text-gray-700">Nenhuma empresa encontrada para os critérios selecionados.</p>
            @else
                <div class="space-y-4">
                    @foreach($empresas as $empresa)
                        <div class="bg-gray-100 p-4 rounded-md shadow-sm">
                            <h2 class="text-xl font-medium text-gray-800">{{ $empresa->razao_social }}</h2>
                            <p class="text-gray-600">CNPJ: {{ $empresa->cnpj }}</p>
                            <p class="text-gray-600">Serviço: {{ $empresa->atividade_principal }}</p>
                            
                            <a href="{{ route('empresas.show', $empresa->id) }}" class="text-blue-600 hover:text-blue-800">
                                Ver Detalhes
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-6">
            <a href="javascript:history.back()" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                ← Voltar
            </a>
        </div>
    </div>
@endsection
