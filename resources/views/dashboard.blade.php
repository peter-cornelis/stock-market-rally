<x-layout>
    <x-slot:title>
        Dashboard
    </x-slot:title>
    <section class="max-w-4xl mx-auto mt-8 px-4">
        <x-header>User's Dashboard </x-header>
        <article class="flex justify-between max-w-3xl mx-auto mt-10 px-6 py-4 bg-white rounded-lg shadow">
            <ul>
                <li title="Totaal fictief vermogen" class="text-2xl font-bold">10.010 USD</li>
                <li title="Fictief gerealiseerde winst/verlies" class="text-sm">+ 10 USD <span class="bg-notice text-white rounded py-0.5 px-1.5">0.1%</span> Sinds start</li>
                <li title="Fictieve cash positie" class="text-sm pt-2">Cash: 2400 USD</li>
            </ul>
            <a class="flex flex-col items-center">
                <span class="material-symbols-outlined text-amber-400">crown</span>
                <span class="text-sm font-semibold">1</span>
            </a>
        </article>

        <ul class="max-w-3xl mx-auto mt-10 px-2 py-2 bg-white rounded-lg shadow">
            <x-equity-card-dashboard />
        </ul>
        
    </section>
</x-layout>