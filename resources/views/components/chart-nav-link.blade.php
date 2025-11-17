@props(['period', 'active' => false])

<a href="?period={{ $period }}" class="px-2 py-1 rounded hover:bg-gray-200 hover:shadow text-xs font-semibold {{ $active ? 'bg-gray-200 shadow' : '' }}">{{ $period }}</a>