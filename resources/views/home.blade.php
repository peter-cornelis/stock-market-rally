<x-layout>
    <x-slot:title>
        Home
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>Stock Market Rally</x-section-header>
        <article class="max-w-3xl mx-auto mt-10 px-6 py-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-semibold">Leren zonder risico</h3>
            <p>
                Een veilige manier om kennis te maken met de beurs en te concurren met andere spelers, via een fictief startkapitaal van 10 000 USD.
                Bij het beleggen is er keuze uit een beperkte selectie van NASDAQ aandelen.
            </p>
        </article>
        <article class="max-w-3xl mx-auto mt-10 px-6 py-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-semibold">Waar kan je jezelf aan verwachten?</h3>
            <ul class="">
                <li>Elke beursdag koersupdates</li>
                <li>selectie van financiele ratio's</li>
                <li>koersgrafiek</li>
            </ul>
            info: data beschikbaar gemaakt via FMP
        </article>
        <article class="max-w-3xl mx-auto mt-10 px-6 py-4 bg-white rounded-lg shadow">
            <h3 class="text-lg font-semibold">Beschikbare aandelen</h3>
            <ul class="">
                @foreach ($equities as $equity)
                    <li>{{ $equity->symbol }} : {{ $equity->name }}</li>
                @endforeach

            </ul>
        </article>
    </section>
</x-layout>