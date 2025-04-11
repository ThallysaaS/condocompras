<div>
    <form wire:submit.prevent="submitForm" class="space-y-4">
        {{ $this->form }}
        <div class="flex justify-end">
            <button type="submit" style="background-color: #FBBF24; color: white; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer;">
                {{ __('Pesquisar') }}
            </button>
        </div>
    </form>

    @if($this->empresas && $this->empresas->count() > 0)
        <div class="mt-8">
            <!-- Serviços Encontrados -->
            <h3 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Serviços Encontrados:</h3>
            <form wire:submit.prevent="salvarCotacao">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($this->empresas as $empresa)
                        @foreach($empresa->servicos as $servico)
                            <div class="shadow-md rounded-lg p-6 hover:shadow-lg transition bg-gray-100 dark:bg-gray-800">
                                <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">{{ $servico->nome }}</h4>
                                <div class="p-4 rounded-lg bg-yellow-200 dark:bg-yellow-500">
                                    <p class="text-gray-900 dark:text-gray-900 mb-1"><strong>Custo:</strong> R$ {{ number_format($servico->custo, 2, ',', '.') }}</p>
                                    <p class="text-gray-900 dark:text-gray-900 mb-1"><strong>Descrição:</strong> {{ $servico->descricao ?? 'Não informado' }}</p>
                                </div>
                                <div class="mt-4">
                                    <input type="checkbox" wire:model="selectedServicos" value="{{ $servico->id }}"> Selecionar
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('empresas.show', $empresa->id) }}" class="text-blue-500 dark:text-blue-400 hover:underline" target="_blank">
                                        Ver Detalhes
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

            <!-- Produtos Encontrados -->
            @if($this->empresas->pluck('produtos')->flatten()->count() > 0)
                <div class="mt-8">
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Produtos Encontrados:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($this->empresas as $empresa)
                            @foreach($empresa->produtos as $produto)
                                <div class="shadow-md rounded-lg p-6 hover:shadow-lg transition bg-gray-100 dark:bg-gray-800">
                                    <h4 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">{{ $produto->nome }}</h4>
                                    <div class="p-4 rounded-lg bg-yellow-200 dark:bg-yellow-500">
                                        <p class="text-gray-900 dark:text-gray-900 mb-1"><strong>Custo:</strong> R$ {{ number_format($produto->custo, 2, ',', '.') }}</p>
                                        <p class="text-gray-900 dark:text-gray-900 mb-1"><strong>Descrição:</strong> {{ $produto->descricao ?? 'Não informado' }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <input type="checkbox" wire:model="selectedProdutos" value="{{ $produto->id }}"> Selecionar
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('empresas.show', $empresa->id) }}" class="text-blue-500 dark:text-blue-400 hover:underline" target="_blank">
                                            Ver Detalhes
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="mt-6 flex justify-end">
                <button type="submit" style="background-color: #22C55E; color: white; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer;">
                    {{ __('Realizar Cotação') }}
                </button>
            </div>
            </form>
        </div>
    @elseif($this->empresas && $this->empresas->count() == 0)
        <div class="mt-8">
            <p class="text-red-500">Nenhum serviço ou produto encontrado para a categoria selecionada.</p>
        </div>
    @endif
</div>
