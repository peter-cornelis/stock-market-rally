<x-layout>
    <x-slot:title>
        {{ $equity->symbol }} {{ $type === 'buy' ? 'Kopen' : 'Verkopen' }}
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>{{ $type === 'buy' ? 'Kopen' : 'Verkopen' }} : {{ $equity->company->name }}</x-section-header>
        <form action="/transactions/{{ $equity->id }}" method="post" class="max-w-md mx-auto mt-8 px-10 py-8 bg-white rounded-lg shadow">
            @csrf
            <x-form-label for="quantity">
                Aantal <x-form-asterix/>
                <x-form-input name="quantity" id="quantity" type="number" value="{{ old('quantity') }}" min="1" step="1" required />
                @error('quantity')
                    <span class="absolute text-error text-sm">{{ $message }}</span>
                @enderror
            </x-form-label>
            <x-form-submit @class(['bg-error hover:bg-error/90' => $type === 'sell']) value="{{ $type === 'buy' ? 'Kopen' : 'Verkopen' }}"/>
        </form>
    </section>
</x-layout>