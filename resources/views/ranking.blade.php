<x-layout>
    <x-slot:title>
        Ranglijst
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>Ranglijst</x-section-header>
        <ul class="max-w-3xl mx-auto mt-10 p-1 bg-white rounded-lg shadow">
            @foreach ($rankings as $ranking)
            <x-ranking-card :$ranking/>
            @endforeach
        </ul>
        {{ $rankings->links() }}
    </section>
</x-layout>