<x-layout>
    <form action="/stocks" method="POST" class="max-w-md mx-auto mt-10 px-10 py-8 bg-white rounded-lg shadow">
        @csrf
        <x-section-header>Aandeel toevoegen</x-section-header>
        <x-form-label for="symbol" class="">
            Symbool <x-form-asterix/>
            <x-form-input name="symbol" id="symbol" required />
        </x-form-label>
        <x-form-submit value="Toevoegen" class="inline-block" />
    </form>           
</x-layout>