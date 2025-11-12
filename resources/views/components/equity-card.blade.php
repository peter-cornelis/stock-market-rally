@props(['equity'])

<li class="mt-8 py-2 px-2 bg-white rounded-lg">
    <a href="/equities/{{ $equity->id }}" class="grid grid-cols-[auto_1fr_auto] gap-6 max-w-4xl py-2 px-4 rounded-lg hover:bg-black/2">
        <img src="{{ $equity->company->image }}" alt="" class="w-16 h-16 my-auto">
        <div>
            <h3 class="text-lg font-semibold">{{ $equity->company->name }}<span class="py-2 text-sm"> | <span class="text-black/60 py-2">{{ $equity->symbol }}</span> | {{ $equity->exchange->name }}</span></h3>   
            <p class="text-sm">
                <b>Sector:</b> {{ $equity->company->sector }} <br>
                <b>Industrie:</b> {{ $equity->company->industry }} <br>
            </p>
        </div>
        <div class="grid grid-flow-row text-right w-fit h-full">
            <span class="font-semibold text-lg" title="laatste koers">{{ $equity->current_price }} {{ $equity->exchange->currency }}</span>
            <span class="font-semibold {{ $equity->daily_change > 0 ? 'text-notice' : 'text-error' }}">{{ $equity->change_percentage }}%</span>
        </div>
    </a>
</li>