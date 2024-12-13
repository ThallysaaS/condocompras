<div>
    <form wire:submit.prevent="submitForm" class="space-y-4">
        {{ $this->form }}
        <div class="flex justify-end">
            <button type="submit" style="background-color: #FBBF24; color: white; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer;">
                {{ __('Prosseguir') }}
            </button>
        </div>
    </form>

    <!-- Exibir os serviços encontrados -->
    @if($this->empresas && $this->empresas->count() > 0)
        <div class="mt-8">
            <h3 class="text-2xl font-semibold mb-4">Serviços Encontrados:</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($this->empresas as $empresa)
                    @foreach($empresa->servicos as $servico)
                        <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                            <h4 class="text-xl font-bold mb-2">{{ $servico->nome }}</h4>
                            <p class="text-gray-700 mb-1"><strong>Custo:</strong> R$ {{ number_format($servico->custo, 2, ',', '.') }}</p>
                            <p class="text-gray-700 mb-1"><strong>Descrição:</strong> {{ $servico->descricao ?? 'Não informado' }}</p>
                            <div class="mt-4">
                                <a href="{{ route('empresas.show', $empresa->id) }}" target="_blank" class="text-blue-500 hover:underline">Ver Dados da Empresa</a>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    @elseif($this->empresas && $this->empresas->count() == 0)
        <div class="mt-8">
            <p class="text-red-500">Nenhum serviço encontrado para a categoria selecionada.</p>
        </div>
    @endif
</div>
