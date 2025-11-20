<x-layout>
    <x-slot:title>
        Aandelen
    </x-slot:title>
    <section class="relative max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>Aandelen</x-section-header>
        <form action="/equities/search" method="POST">
            @csrf
            <x-form-input type="search" name="q" class="rounded-full shadow mx-auto max-w-sm" placeholder="Geef bedrijfsnaam ..."/>
        </form>
        @if(auth()->user() && auth()->user()->admin)
            <a href="/equities/create" title="Aandeel toevoegen" class="absolute top-0 right-6 p-0.5 text-white bg-notice hover:bg-notice/80 border border-black/20 rounded-2xl material-symbols-outlined">add</a>         
        @endif
        <ul>
            @forelse ($equities as $equity)
                <x-equity-card :$equity/>
            @empty
                <li class="text-xl text-center mt-10 text-black/50">Geen resultaten gevonden.</li>
            @endforelse
        </ul>
        {{ $equities->links() }}
    </section>
</x-layout>