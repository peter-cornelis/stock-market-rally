@props(['period', 'active' => false])

<a href="?period={{ $period }}" class="px-2 py-1 rounded hover:bg-black/3 hover:shadow border border-black/5 text-xs font-semibold {{ $active ? 'bg-black/5 shadow border border-black/10' : '' }}">{{ $period }}</a>