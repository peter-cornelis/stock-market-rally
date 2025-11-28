@props(['href', 'active' => false])

<li>
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $active ? 'text-black/70 underline' : 'text-black/50 hover:text-black/70']) }}>{{ $slot }}</a>
</li>