@props(['action', 'placeholder'])

<form action="{{ $action }}" method="POST" class="relative mx-2">
    @csrf
    <x-form-input type="search" name="searchQuery" class="rounded-full shadow mx-auto max-w-sm outline-black/50" placeholder="{{ $placeholder }}" required autofocus/>
    @error('searchQuery')
        <p class="absolute left-[50%] -translate-x-1/2 text-error text-sm">{{ $message }}</p>
    @enderror
</form>