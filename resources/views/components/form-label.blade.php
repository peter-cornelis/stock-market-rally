@props(['for'])

<label for="{{ $for }}" class="block relative mb-6">
    {{ $slot }}
</label>