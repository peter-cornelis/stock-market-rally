@props(['ranking'])

<li class="border-b last:border-none border-black/20">
    <a href="/users/{{ $ranking['user_id'] }}/transactions" class="flex justify-between px-4 py-2 hover:bg-black/2">
        <div class="grid grid-flow-row">
            <h3 class="font-semibold">
                <span class="text-black/60 py-2">{{ $ranking['ranking'] }}</span> | {{ $ranking['username'] }}</h3>
            <span class="text-xs font-bold">{{ $ranking['transactions'] }} transacties</span>
        </div>
        <div class="grid grid-flow-row text-right">
            <span>{{ $ranking['portfolio_value'] }} USD</span>
            <p class="text-xs">{{ $ranking['portfolio_gain'] }} USD <span class="{{ $ranking['portfolio_gain'] >= 0 ? 'bg-notice' : 'bg-error' }} text-white font-semibold rounded py-px px-1 shadow">{{ $ranking['portfolio_gain_percentage'] }} %</span></p>
        </div>
    </a>
</li>