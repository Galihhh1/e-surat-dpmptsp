<x-app-layout>
    <x-slot name="header">
        Dashboard Admin TU
    </x-slot>

    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">
            Dashboard Admin TU
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

            <div class="bg-white dark:bg-gray-800 p-5 rounded shadow">
                <p>Total Surat</p>
                <h2 class="text-3xl font-bold">{{ $totalSurat }}</h2>
            </div>

            <div class="bg-white dark:bg-gray-800 p-5 rounded shadow">
                <p>Masuk</p>
                <h2 class="text-3xl font-bold">{{ $suratMasuk }}</h2>
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
               class="px-4 py-2 bg-blue-600 text-white rounded">
                Kelola Surat Masuk
            </a>

            <a href="{{ route('bidangs.index') }}"
               class="ml-2 px-4 py-2 bg-gray-600 text-white rounded">
                Kelola Bidang
            </a>
        </div>
    </div>
</x-app-layout>