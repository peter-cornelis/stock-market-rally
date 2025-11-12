<x-layout>
    <x-slot:title>
        {{ $equity->symbol }}
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>{{ $equity->company->name }}</x-section-header>

        @if($equity->financialRatio)
        <article class="grid grid-cols-[auto_1fr_1fr_1fr] text-center max-w-3xl mx-auto mt-10 px-6 py-4 bg-white rounded-lg shadow">
            <div class="text-left pr-10">
                <h3 class="text-lg font-bold text-black/50 mb-2">Financiele ratio's</h3>
                Beta waarde: {{ $equity->financialRatio->beta }} <br>
                Omzet per aandeel: {{ $equity->financialRatio->revenuePerShare }} <br>
                dividendrendement:
                {{ $equity->financialRatio->dividendYieldPercentage }} %
            </div>
            <div class="relative border-l border-black/20 my-auto">
                <h3 title="Koers / Winst verhouding">K/W ratio</h3>
                <span class="block mt-2 font-bold">{{ $equity->financialRatio->priceToEarningsRatio }}</span>
                <x-tooltip id="popover-kw-ratio">
                    Geeft weer hoeveel keer men de winst van het bedrijf betaald bij aankoop van een aandeel.
                </x-tooltip>
            </div>
            <div class="relative border-l border-black/20 my-auto">
                <h3 title="Koers / Boekwaarde verhouding">K/B ratio</h3>
                <span class="block mt-2 font-bold">{{ $equity->financialRatio->priceToBookRatio }}</span>
                <x-tooltip id="popover-kb-ratio">
                    Geeft de verhouding van de koers van het aandeel tegenover de boekwaarde.
                    Ratio lager dan 1 kan wijzen op een onderwaardering.
                </x-tooltip>
            </div>
            <div class="relative border-l border-black/20 my-auto">
                <h3>Current ratio</h3>
                <span class="block mt-2 font-bold">{{ $equity->financialRatio->currentRatio }}</span>
                <x-tooltip id="popover-current-ratio">
                    Geeft de korte termijn liquiditeit weer van een bedrijf. 
                    Een ratio van 1 of hoger geeft aan dat de kortlopende schulden kleiner zijn dan de kortlopende activa.
                </x-tooltip>
            </div>
        </article>
        @else
        <article class="max-w-3xl mx-auto mt-10 px-6 py-4 bg-white rounded-lg shadow">
            <p class="text-center text-black/50">Geen financiële ratio's beschikbaar voor dit aandeel.</p>
        </article>
        @endif
    </section>
</x-layout>