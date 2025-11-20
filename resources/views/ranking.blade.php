<x-layout>
    <x-slot:title>
        Ranglijst
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>Ranglijst</x-section-header>
        <x-form-search-form action="/ranking/search" placeholder="Geef gebruikersnaam ..." />
        <ul class="max-w-3xl mx-auto mt-8 p-1 bg-white rounded-lg shadow">
            @foreach ($rankings as $ranking)
            <x-ranking-card :$ranking/>
            @endforeach
        </ul>
        {{ $rankings->links() }}
    </section>
</x-layout>