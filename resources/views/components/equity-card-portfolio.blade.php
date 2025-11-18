<li class="border-b last:border-none border-black/10">
    <a href="/equities/{{ $equity->id }}" class="flex justify-between px-4 py-2 hover:bg-black/2">
        <div class="grid grid-flow-row">
            <h3 class="font-semibold">{{ $equity->company->name }} | <span class="text-black/60 py-2">{{ $equity->symbol }}</span></h3>
            <span class="text-xs font-bold">{{ $equity->quantity }} aandelen</span>
        </div>
        <div class="grid grid-flow-row text-right">
            <span>{{ $equity->value }} USD</span>
            <p class="text-xs">{{ $equity->value_change }} USD <span class="{{ $equity->value_change >= 0 ? 'bg-notice' : 'bg-error' }} text-white font-semibold rounded py-px px-1 shadow">{{ $equity->value_change_percentage }} %</span></p>
        </div>
    </a>
</li>