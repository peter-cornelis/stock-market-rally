<x-layout>
    <x-slot:title>
        Aanmelden
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 md:px-4">
        <x-section-header>Aanmelden</x-section-header>
        <form action="/login" method="post" class="max-w-md mx-auto mt-8 px-10 py-8 bg-white md:rounded-lg shadow">
            @csrf
            <x-form-label for="email">
                E-Mailadres <x-form-asterix/>
                <x-form-input name="email" id="email" type="email" value="{{ old('email') }}" required />
                @error('email')
                    <span class="absolute text-error text-sm">{{ $message }}</span>
                @enderror
            </x-form-label>
            <x-form-label for="password">
                Wachtwoord <x-form-asterix/>
                <x-form-input name="password" id="password" type="password" required />
            </x-form-label>
            <x-form-submit value="Aanmelden" />
            <p class="text-sm text-right mt-4">
                Nog geen account?
                <a href="/register" class="text-blueFin hover:underline italic">Registreer</a> 
                je hier.
            </p>
        </form>
    </section>
</x-layout>