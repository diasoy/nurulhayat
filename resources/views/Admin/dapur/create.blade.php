<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah User Dapur
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
            <form method="POST" action="{{ route('admin.dapur.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block">Nama</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block">Email</label>
                    <input type="email" name="email" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block">Password</label>
                    <input type="password" name="password" class="w-full border rounded p-2" required>
                </div>
                <div class="mb-4">
                    <label class="block">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('admin.dapur.index') }}" class="ml-2 text-gray-600">Batal</a>
            </form>
        </div>
    </div>
</x-app-layout>