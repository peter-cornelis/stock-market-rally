@props(['value'])

<input type="submit" value="{{ $value }}" {{ $attributes->merge(['class' => 'block w-full bg-blueFin hover:bg-blueFin/90 text-white font-bold rounded border border-black/20 shadow px-3 py-2 mt-8']) }}>