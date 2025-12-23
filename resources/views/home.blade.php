<x-layout>
    <x-slot:title>
        Home
    </x-slot:title>
    <section class="grid grid-cols-[auto] gap-x-8 max-w-4xl mx-auto my-8 sm:px-4">
        <x-section-header class="sm:col-span-2 mb-12">Stock Market Rally</x-section-header>
        <article class="max-w-3xl min-w-3xs max-sm:mx-4 md:ml-auto px-6 py-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-semibold">Oefenen zonder risico</h3>
            <p>
                Een leuke en veilige manier om kennis te maken met de beurs en te concurreren met andere spelers, via een fictief startkapitaal van 40.000,00 USD.
                Bij het beleggen is er keuze uit een beperkte selectie van technologie aandelen die noteren op de NASDAQ.
            </p>
        </article>
        <article class="max-w-3xl max-sm:mt-8 px-6 max-sm:mx-4 mx-auto py-4 mb-auto md:mt-0 text-white bg-blueFin rounded-lg shadow border border-black/20">
            <h3 class="text-lg font-semibold">Waar kan je jezelf aan verwachten?</h3>
            <ul class="list-disc pl-5 mt-2">
                <li>Elke beursdag koersupdates</li>
                <li>Selectie van financiele ratio's</li>
                <li>Koersgrafieken</li>
                <li>Ai advies gebasseerd op een technische analyse van het aandeel.</li>
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
        <x-section-header class="mt-16 mb-12">Statistieken {{ now()->year }}</x-section-header>
        <ul class="grid grid-flow-row sm:grid-cols-2 lg:grid-cols-3 gap-x-18 gap-y-12 text-white mx-auto">
            <li title="eerste speler in ranking" class="sm:col-span-2 lg:col-span-1 lg:col-start-2 text-center py-4 w-52 h-52 mx-auto bg-goldFin border border-black/20 rounded-3xl shadow">
                <h3 class="text-lg font-semibold">#1</h3>
                <span class="block text-xl font-bold px-2 wrap-break-word mt-6 mb-1">{{ $statistics['highestRankedUsername'] }}</span>
                <span class="inline-block text-xl font-semibold px-2 wrap-break-word bg-white/15 border border-white/60 mx-2 rounded-xl">{{ number_format($statistics['highestRankedPortfolioValue'], 2, ',', '.') }}</span>
                <span class="block text-sm px-2 wrap-break-word mb-4">USD</span>
            </li>
            <li title="actieve spelers" class="lg:col-start-1 lg:row-start-1 text-center py-4 w-52 h-52 mx-auto bg-blueFin border border-black/20 rounded-3xl shadow">
                <h3 class="text-xl font-semibold">Actieve spelers</h3>
                <span class="flex w-24 h-24 text-4xl font-bold bg-black/15 justify-center items-center mx-auto mt-6 rounded-full border border-black/10">{{ $statistics['totalActiveUsers'] }}</span>
            </li>
            <li title="aantal transacties" class="text-center mx-auto py-4 w-52 h-52 bg-notice border border-black/20 rounded-3xl shadow">
                <h3 class="text-xl font-semibold">Transacties</h3>
                <span class="flex w-24 h-24 text-4xl font-bold bg-black/15 justify-center items-center mx-auto mt-6 rounded-full border border-black/10">{{ $statistics['totalTransactions'] }}</span>
            </li>
        </ul>
    </section>
</x-layout>