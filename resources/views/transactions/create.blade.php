<x-layout>
    <x-slot:title>
        {{ $equity->symbol }} {{ $type === 'buy' ? 'Kopen' : 'Verkopen' }}
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>{{ $type === 'buy' ? 'Kopen' : 'Verkopen' }} : {{ $equity->company->name }}</x-section-header>
        
        <ul>

        </ul>
    </section>
</x-layout>