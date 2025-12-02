<x-layout>
    <x-slot:title>
        {{ $equity->symbol }} {{ $type === 'buy' ? 'Kopen' : 'Verkopen' }}
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>{{ $type === 'buy' ? 'Kopen' : 'Verkopen' }} : {{ $equity->company->name }}</x-section-header>
        <form action="/transactions/{{ $equity->id }}" id="transaction-form" method="post" class="max-w-md mx-auto mt-8 px-10 py-8 bg-white rounded-lg shadow" data-price="{{ $equity->current_price }}" data-balance="{{ auth()->user()->balance }}">
            @csrf
            <x-form-label for="quantity">
                Aantal <x-form-asterix/>
                <x-form-input name="quantity" id="quantity" type="number" value="{{ old('quantity') }}" min="1" step="1" required />
                @error('quantity')
                    <span class="absolute text-error text-sm">{{ $message }}</span>
                @enderror
            </x-form-label>
            <input name="type" id="type" value="{{ $type }}" hidden>
            
            <ul class="px-4 pt-4 text-black/70 border-t border-black/20">
                <li>Bruto:  <span id="gross">0</span> {{ $equity->exchange->currency}}</li>
                <li>Kosten: <span id="fee">0</span> {{ $equity->exchange->currency}}</li>
                <li>Totaal:  <span id="total">0</span> {{ $equity->exchange->currency}}</li>
                <li>Cash:  <span id="cash">{{ auth()->user()->balance }}</span> {{ $equity->exchange->currency}}</li>
            </ul>
            <x-form-submit @class(['bg-error hover:bg-error/90' => $type === 'sell']) value="{{ $type === 'buy' ? 'Kopen' : 'Verkopen' }}"/>
        </form>
    </section>
</x-layout>