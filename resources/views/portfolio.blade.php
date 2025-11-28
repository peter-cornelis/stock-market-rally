<x-layout>
    <x-slot:title>
        Portefeuille
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 md:px-4">
        <x-section-header>{{ $user->username }}'s Portefeuille </x-section-header>
        <article class="flex justify-between max-w-3xl mx-auto mt-8 px-6 py-4 bg-white md:rounded-lg shadow">
            <ul>
                <li title="Totaal fictief vermogen"><h3 class="text-2xl font-bold">{{ number_format($user->portfolio_value, 2, ',', '.') }} USD</h3></li>
                <li title="Fictief gerealiseerde winst/verlies" class="text-sm">{{ number_format($user->portfolio_gain, 2, ',', '.') }} USD <span class="{{ $user->portfolio_gain >= 0 ? 'bg-notice' : 'bg-error' }} text-white font-semibold rounded py-px px-1 shadow">{{ $user->portfolio_gain_percentage }} %</span> Sinds start</li>
                <li title="Fictieve cash positie" class="text-sm pt-2">Cash: {{ number_format($user->balance, 2, ',', '.') }} USD</li>
            </ul>
            <a class="flex flex-col items-center">
                <span class="material-symbols-outlined text-goldFin">crown</span>
                <span class="text-sm font-semibold">{{ $user->ranking }}</span>
            </a>
        </article>

        <ul class="max-w-3xl mx-auto mt-10 p-1 bg-white md:rounded-lg shadow">
            @forelse ($equitiesPaginator as $equity)
                <x-equity-card-portfolio :$equity />
            @empty
                <li class="text-xl text-center text-black/50">Nog geen aandelen toegevoegd.</li>
            @endforelse
        </ul>
        <div class="max-w-3xl mx-auto">
            {{ $equitiesPaginator->links() }}
        </div>
    </section>
</x-layout>