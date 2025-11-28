@props(['href', 'active' => false])

<li>
    <a href="{{ $href }}" class="inline-block text-center w-full py-2 px-5 my-1 rounded hover:bg-black/3 hover:shadow border hover:border-black/5 {{ $active ? 'text-black/70 bg-black/5 border border-black/10 shadow' : 'text-black/50 hover:text-black/70 border-transparent' }}">{{ $slot }}</a>
</li>