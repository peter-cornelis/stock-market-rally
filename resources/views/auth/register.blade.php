<x-layout>
    <x-slot:title>
        Aanmelden
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 md:px-4">
        <x-section-header>Account aanmaken</x-section-header>
        <form action="/register" method="post" class="max-w-md mx-auto mt-8 px-10 py-8 bg-white 2sm:rounded-lg shadow">
            @csrf
            <x-form-label for="first_name">
                Voornaam <x-form-asterix/>
                <x-form-input name="first_name" id="first_name" value="{{ old('first_name') }}" required />
                @error('first_name')
                    <span class="absolute text-error text-sm">{{ $message }}</span>
                @enderror
            </x-form-label>
            <x-form-label for="last_name">
                Familienaam <x-form-asterix/>
                <x-form-input name="last_name" id="last_name" value="{{ old('last_name') }}" required/>
                @error('last_name')
                    <span class="absolute text-error text-sm">{{ $message }}</span>
                @enderror
            </x-form-label>
            <x-form-label for="username">
                Gebruikersnaam <x-form-asterix/>
                <x-form-input name="username" id="username" type="text" value="{{ old('username') }}" required />
                @error('username')
                    <span class="absolute text-error text-sm">{{ $message }}</span>
                @enderror
            </x-form-label>
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
                @error('password')
                    <span class="absolute text-error text-sm">{{ $message }}</span>
                @enderror
            </x-form-label>
            <span class="block text-black/40 text-sm -mt-1 mb-3" id="12chars">&#x2713; Minstens 12 karakters vereist</span>
            <x-form-label for="password_confirmation">
                Bevestig Wachtwoord <x-form-asterix/>
                <x-form-input name="password_confirmation" id="password_confirmation" type="password" required />
            </x-form-label>
            <x-form-submit value="Registreer" />
            <script>
                "use strict";
                document.getElementById("password").oninput = () => {
                    const length = document.getElementById('password').value.length;
                    if(length >= 12) {
                        document.getElementById('12chars').classList.add('text-notice');
                    } else {
                        document.getElementById('12chars').classList.remove('text-notice');
                    }
                }
            </script>
        </form>
    </section>
</x-layout>