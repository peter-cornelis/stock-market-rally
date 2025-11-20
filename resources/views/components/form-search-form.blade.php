@props(['action', 'placeholder'])

<form action="{{ $action }}" method="POST">
    @csrf
    <x-form-input type="search" name="q" class="rounded-full shadow mx-auto max-w-sm" placeholder="{{ $placeholder }}"/>
</form>