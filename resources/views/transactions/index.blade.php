<x-layout>
    <x-slot:title>
        {{ $username }} Transacties
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-section-header>
            <x-previous-link/>
            {{ $username }}'s transacties
        </x-section-header>
        <ul class="max-w-3xl mx-auto mt-10 p-1 bg-white rounded-lg shadow">
            @foreach ($transactionList as $transaction)
                <li class="flex py-2 border-b border-black/10 last:border-none">
                    <span class="inline-block w-35 px-2 border-r border-black/20">{{ date('Y/m/d h:m', strtotime($transaction->date)) }}</span>
                    <span class="inline-block px-2">{{ $transaction->quantity }} x {{ $transaction->company_name }} @ {{ $transaction->price }}</span>
                    <span class="inline-flex px-2 ml-auto font-bold text-white mr-1 shadow rounded {{ $transaction->type == 'buy' ? 'bg-notice' : 'bg-error' }}" title="{{ $transaction->type == 'buy' ? 'aankoop' : 'verkoop' }} totaal">{{ $transaction->total }} {{ $transaction->currency }}</span>
                </li>
            @endforeach
        </ul>

    </section>
</x-layout>