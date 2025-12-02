<x-layout>
    <x-slot:title>
        {{ $username }} Transacties
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 md:px-4">
        <x-section-header>
            <x-previous-link/>
            {{ $username }}'s transacties
        </x-section-header>
        <ul class="max-w-3xl mx-auto mt-10 p-1 bg-white md:rounded-lg shadow">
            @foreach ($transactionList as $transaction)
                <li class="grid grid-cols-[auto_1fr] md:grid-cols-[auto_1fr_auto] py-2 border-b border-black/10 last:border-none">
                    <span class="inline-block max-md:row-span-2 min-w-18 w-18 sm:w-30 px-2 border-r border-black/20">{{ $transaction->date->format('d M Y') }}</span>
                    <div class="flex px-2 "><span class=" truncate">{{ $transaction->quantity }} x {{ $transaction->company_name }} </span><span class="shrink-0">@ {{ number_format($transaction->price, 2, ',', '.') }}</span></div>
                    <span class="inline-block px-2 text-center ml-2 md:ml-auto font-bold text-white mr-1 shadow rounded {{ $transaction->type == 'buy' ? 'bg-notice' : 'bg-error' }}" title="{{ $transaction->type == 'buy' ? 'aankoop' : 'verkoop' }} totaal">{{ number_format($transaction->total, 2, ',', '.') }} {{ $transaction->currency }}</span>
                </li>
            @endforeach
        </ul>

    </section>
</x-layout>