<x-layout>
    <x-slot:title>
        Aandelen
    </x-slot:title>
    <section class="relative max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>Aandelen</x-section-header>
        <ul>
            @foreach ($equities as $equity)
                <x-equity-card :$equity/>
            @endforeach
            <li>
                <a href="">

                </a>
            </li>
        </ul>
    </section>
</x-layout>