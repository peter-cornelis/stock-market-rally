<x-layout>
    <x-slot:title>
        Home
    </x-slot:title>
    <section class="grid grid-cols-1 md:grid-cols-[1fr] gap-x-8 gap-y-8 max-w-4xl mx-auto my-8 px-4">
        <x-section-header class="md:col-span-2">Stock Market Rally</x-section-header>
        <article class="max-w-3xl md:ml-auto -mt-8 px-6 py-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-semibold">Leren zonder risico</h3>
            <p>
                Een leuke en veilige manier om kennis te maken met de beurs en te concurreren met andere spelers, via een fictief startkapitaal van 10 000 USD.
                Bij het beleggen is er keuze uit een beperkte selectie van technologie aandelen die noteren op de NASDAQ.
            </p>
        </article>
        <article class="max-w-3xl md:-mt-8 px-6 py-4 text-white bg-blueFin rounded-lg shadow border border-black/20">
            <h3 class="text-lg font-semibold">Waar kan je jezelf aan verwachten?</h3>
            <ul class="list-disc pl-5 mt-2">
                <li>Elke beursdag koersupdates</li>
                <li>Selectie van financiele ratio's</li>
                <li>Koersgrafieken</li>
                <li>Recentste bedrijfsgerelateerd nieuws</li>
            </ul>
            <p class="text-xs mt-2">Data beschikbaar gemaakt via 
                <a 
                    href="https://site.financialmodelingprep.com/" 
                    target="_blank" 
                    title="link naar Financial Modeling Prep" class="underline">
                    FMP
                </a>
                .
            </p>
        </article>
    </section>
    <section class="w-fit mx-auto px-4">
        <x-section-header class="md:col-span-2">Statistieken {{ now()->year }}</x-section-header>
        <ul class="grid grid-cols-2 md:grid-cols-3 gap-18 text-white mx-auto">
                <li title="aantal transacties" class="text-center py-4 min-w-38 bg-blueFin border border-black/20 rounded shadow">
                    <h3 class="text-lg font-semibold">Actieve spelers</h3>
                    <span class="flex w-16 h-16 text-3xl font-bold bg-black/3 justify-center items-center mx-auto my-4 rounded-full border border-black/10">{{ $statistics['totalActiveUsers'] }}</span>
                </li>
                <li title="aantal transacties" class="text-center py-4 min-w-38 bg-notice border border-black/20 rounded shadow">
                    <h3 class="text-lg font-semibold">Transacties</h3>
                    <span class="flex w-16 h-16 text-3xl font-bold bg-black/3 justify-center items-center mx-auto my-4 rounded-full border border-black/10">{{ $statistics['totalTransactions'] }}</span>
                </li>
                <li title="eerste speler in ranking" class="text-center py-4 min-w-38 max-w-42 bg-yellow-500 border border-black/20 rounded shadow">
                    <h3 class="text-lg font-semibold">#1</h3>
                    <span class="block text-xl px-2 wrap-break-word mt-2 mb-1">{{ $statistics['highestRankedUsername'] }}</span>
                    <span class="inline-block font-semibold px-2 wrap-break-word bg-white/7 border border-white/40 mx-2 rounded-xl">{{ $statistics['highestRankedPortfolioValue'] }}</span>
                    <span class="block text-xs px-2 wrap-break-word mb-4">USD</span>
                </li>
            </ul>
    </section>
</x-layout>