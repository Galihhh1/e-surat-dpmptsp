<x-app-layout>
    <x-slot name="header">
        Dashboard User Bidang
    </x-slot>

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">
            Dashboard User Bidang
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="bg-white dark:bg-gray-800 p-5 rounded shadow">
                <p>Total Surat Bidang</p>
                <h2 class="text-3xl font-bold">{{ $totalSurat }}</h2>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded shadow">
                <p>Didisposisikan</p>
                <h2 class="text-3xl font-bold">{{ $didisposisikan }}</h2>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded shadow">
                <p>Diproses</p>
                <h2 class="text-3xl font-bold">{{ $diproses }}</h2>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded shadow">
                <p>Selesai</p>
                <h2 class="text-3xl font-bold">{{ $selesai }}</h2>
            </div>

        </div>

        <div class="mt-6">
            <a href="{{ route('surat-masuks.index') }}"
               class="px-4 py-2 bg-green-600 text-white rounded">
                Lihat Surat Bidang
            </a>
        </div>
    </div>
</x-app-layout>