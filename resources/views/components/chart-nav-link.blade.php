@props(['period'])

<button 
    class="chartBtn px-2 py-1 rounded hover:bg-black/3 hover:shadow border border-black/5 text-xs font-semibold"
    data-period="{{ $period }}"
>
    {{ $period }}
</button>