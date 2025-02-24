<div class="flex items-center justify-center space-x-2">
    @foreach(range(0, 10) as $value)
        <button
            type="button"
            wire:click="$set('{{ $getStatePath() }}', {{ $value }})"
            class="w-10 h-10 rounded-lg text-white font-bold flex items-center justify-center
            @if($getState() === $value) ring-4 ring-gray-300 @endif"
        >
            {{ $value }}
        </button>
    @endforeach
</div>
