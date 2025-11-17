<x-layout>
    <x-slot:title>
        Aandelen
    </x-slot:title>
    <section class="relative max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>Aandelen</x-section-header>
        @if(auth()->user() && auth()->user()->admin)
            <a href="/equities/create" title="Aandeel toevoegen" class="absolute top-0 right-6 p-0.5 text-white bg-notice hover:bg-notice/80 border border-black/20 rounded-2xl material-symbols-outlined">add</a>         
        @endif
        <ul>
            @foreach ($equities as $equity)
                <x-equity-card :$equity/>
            @endforeach
        </ul>
        {{ $equities->links() }}
    </section>
</x-layout>