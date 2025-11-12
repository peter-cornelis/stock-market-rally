@props(['id', 'placement' => 'top'])

<button data-popover-target="{{ $id }}" data-popover-placement="{{ $placement }}"
        class="text-blueFin/70 hover:text-blueFin mt-2 material-symbols-outlined">
        info
</button>
<div data-popover id="{{ $id }}" role="tooltip"
     class="absolute z-10 invisible inline-block w-64 p-2 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-blueFin/25 rounded-lg shadow-sm opacity-0">
    {{ $slot }}
</div>