<x-layout>
    <x-slot:title>
        Portefeuille
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>{{ $user->first_name }}'s Portefeuille </x-section-header>
        <article class="flex justify-between max-w-3xl mx-auto mt-10 px-6 py-4 bg-white rounded-lg shadow">
            <ul>
                <li title="Totaal fictief vermogen"><h3 class="text-2xl font-bold">{{ $user->portfolio_value }} USD</h3></li>
                <li title="Fictief gerealiseerde winst/verlies" class="text-sm">{{ $user->portfolio_gain }} USD <span class="{{ $user->portfolio_gain >= 0 ? 'bg-notice' : 'bg-error' }} text-white font-semibold rounded py-px px-1 shadow">{{ $user->portfolio_gain_percentage }} %</span> Sinds start</li>
                <li title="Fictieve cash positie" class="text-sm pt-2">Cash: {{ $user->balance }} USD</li>
            </ul>
            <a class="flex flex-col items-center">
                <span class="material-symbols-outlined text-amber-400">crown</span>
                <span class="text-sm font-semibold">1</span>
            </a>
        </article>

        <ul class="max-w-3xl mx-auto mt-10 px-2 py-2 bg-white rounded-lg shadow">
            @forelse ($user->equities as $equity)
                <x-equity-card-dashboard :$equity />
            @empty
                <li class="text-xl text-center text-black/50">Nog geen aandelen toegevoegd.</li>
            @endforelse
        </ul>
        
    </section>
</x-layout>