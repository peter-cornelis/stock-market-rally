@props(['ranking'])

<li class="border-b last:border-none border-black/10" title="Geef transacties weer">
    <a href="/users/{{ $ranking['id'] }}/transactions" class="flex justify-between px-4 py-2 hover:bg-black/2">
        <div class="grid grid-flow-row">
            <h3 class="font-semibold">
                <span class="text-black/60 py-2">{{ $ranking['ranking'] }}</span> | {{ $ranking['username'] }}</h3>
            <span class="text-xs font-bold">{{ $ranking['transactions_count'] }} transacties</span>
        </div>
        <div class="grid grid-flow-row text-right">
            <span>{{ number_format($ranking['portfolio_value'], 2, ',', '.') }} USD</span>
            <p class="text-xs">{{ number_format($ranking['portfolio_gain'], 2, ',', '.') }} USD <span class="{{ $ranking['portfolio_gain'] >= 0 ? 'bg-notice' : 'bg-error' }} text-white font-semibold rounded py-px px-1 shadow">{{ $ranking['portfolio_gain_percentage'] }} %</span></p>
        </div>
    </a>
</li>