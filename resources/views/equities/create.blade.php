<x-layout>
    <form action="/equities" method="POST" class="max-w-md mx-auto mt-10 px-10 py-8 bg-white rounded-lg shadow">
        @csrf
        <x-section-header>Aandeel toevoegen</x-section-header>
        <x-form-label for="symbol">
            Symbool <x-form-asterix/>
            <x-form-input name="symbol" id="symbol" required />
            @error('symbol')
                <span class="absolute text-error text-sm">{{ $message }}</span>
            @enderror
        </x-form-label>
        <x-form-submit value="Toevoegen" />
    </form>           
</x-layout>