<div class="flex items-center justify-center space-x-2">
    <span>Muito Baixo</span>
    @foreach(range(0, 5) as $value)
        <button
            type="button"
            wire:click="$set('{{ $getStatePath() }}', {{ $value }})"
            class="w-10 h-10 rounded-lg text-white font-bold flex items-center justify-center
            @if($getState() === $value) ring-4 ring-gray-300 @endif"
        >
            {{ $value }}
        </button>
    @endforeach
    <span>Muito Alto</span>
</div>
