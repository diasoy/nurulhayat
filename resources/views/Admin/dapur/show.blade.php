<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail User Dapur
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
            <div class="mb-4">
                <strong>Nama:</strong> {{ $user->name }}
            </div>
            <div class="mb-4">
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <a href="{{ route('admin.dapur.index') }}" class="text-blue-600">Kembali</a>
        </div>
    </div>
</x-app-layout>