@props(['href', 'active' => false])

<li>
    <a href="{{ $href }}" class="inline-block w-full py-2 px-4 rounded hover:bg-black/3 {{ $active ? 'text-black/70 bg-black/7' : 'text-black/50 hover:text-black/70' }}">{{ $slot }}</a>
</li>