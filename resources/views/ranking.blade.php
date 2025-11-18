<x-layout>
    <x-slot:title>
        Ranglijst
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>Ranglijst</x-section-header>
        <ul>
            @foreach ($rankings as $ranking)
            <x-ranking-card :$ranking/>
            @endforeach
        </ul>
    </section>
</x-layout>