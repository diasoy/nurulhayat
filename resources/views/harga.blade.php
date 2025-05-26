<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Daftar Harga Aqiqah Nurul Hayat</title>
    <meta name="description" content="Daftar harga layanan aqiqah Nurul Hayat Surabaya dengan berbagai pilihan paket.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
</head>

<body class="antialiased bg-gradient-to-br from-primary-light/10 to-white dark:from-primary-dark dark:to-gray-900 min-h-screen">
    <header class="relative">
        <nav class="container mx-auto px-6 py-4 shadow-md">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="py-4 mr-20">
                        <span class="text-2xl font-bold text-primary dark:text-secondary">Nurul Hayat</span>
                    </div>
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ url('/') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-secondary transition">Home</a>
                        <a href="#top" class="text-primary dark:text-secondary transition">Harga</a> {{-- Active link for current page --}}
                        <a href="{{ url('/order') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-secondary transition">Order</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-12" id="top">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white text-center mb-6">Daftar Harga Aqiqah</h1>
        <p class="text-gray-600 dark:text-gray-300 text-center max-w-3xl mx-auto mb-12">Pilih paket aqiqah yang sesuai dengan kebutuhan dan budget Anda. Semua paket kami proses sesuai syariat Islam dengan kualitas terjamin.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <!-- Paket Platinum -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-xl">
                <div class="bg-primary p-6 text-center">
                    <h2 class="text-2xl font-bold text-white">Paket Platinum</h2>
                    <p class="text-secondary-light font-medium mt-1">Premium Quality</p>
                </div>
                <div class="p-6">
                    <div class="text-center mb-8">
                        <span class="text-4xl font-bold text-gray-800 dark:text-white">Rp3.500.000</span>
                        <p class="text-gray-500 dark:text-gray-400">per ekor</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Kambing premium pilihan (35-40kg)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Menu masakan premium (6 jenis)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Porsi 400-450 box</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Free sertifikat aqiqah</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Free pengiriman area kota</span>
                        </li>
                    </ul>
                    <a href="{{ url('/order') }}" class="block text-center py-3 px-6 bg-secondary hover:bg-secondary-dark text-primary font-semibold rounded-lg transition duration-300">Pilih Paket</a>
                </div>
            </div>

            <!-- Paket Istimewa -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform scale-105 z-10 transition-transform hover:-translate-y-1 hover:shadow-xl">
                <div class="bg-secondary p-6 text-center">
                    <h2 class="text-2xl font-bold text-primary">Paket Istimewa</h2>
                    <p class="text-primary-light font-medium mt-1">Best Value</p>
                </div>
                <div class="p-6">
                    <div class="text-center mb-8">
                        <span class="text-4xl font-bold text-gray-800 dark:text-white">Rp2.800.000</span>
                        <p class="text-gray-500 dark:text-gray-400">per ekor</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Kambing istimewa (30-35kg)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Menu masakan istimewa (5 jenis)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Porsi 350-400 box</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Free sertifikat aqiqah</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Free pengiriman area kota</span>
                        </li>
                    </ul>
                    <a href="{{ url('/order') }}" class="block text-center py-3 px-6 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg transition duration-300">Pilih Paket</a>
                </div>
            </div>

            <!-- Paket Super -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-xl">
                <div class="bg-primary p-6 text-center">
                    <h2 class="text-2xl font-bold text-white">Paket Super</h2>
                    <p class="text-secondary-light font-medium mt-1">Affordable</p>
                </div>
                <div class="p-6">
                    <div class="text-center mb-8">
                        <span class="text-4xl font-bold text-gray-800 dark:text-white">Rp2.300.000</span>
                        <p class="text-gray-500 dark:text-gray-400">per ekor</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Kambing super (28-32kg)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Menu masakan standar (4 jenis)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Porsi 300-350 box</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Free sertifikat aqiqah</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Free pengiriman area kota</span>
                        </li>
                    </ul>
                    <a href="{{ url('/order') }}" class="block text-center py-3 px-6 bg-secondary hover:bg-secondary-dark text-primary font-semibold rounded-lg transition duration-300">Pilih Paket</a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- Paket Puas -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-xl">
                <div class="bg-primary p-6 text-center">
                    <h2 class="text-2xl font-bold text-white">Paket Puas</h2>
                    <p class="text-secondary-light font-medium mt-1">Budget Friendly</p>
                </div>
                <div class="p-6">
                    <div class="text-center mb-8">
                        <span class="text-4xl font-bold text-gray-800 dark:text-white">Rp1.950.000</span>
                        <p class="text-gray-500 dark:text-gray-400">per ekor</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Kambing standar (25-28kg)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Menu masakan dasar (3 jenis)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Porsi 250-300 box</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Free sertifikat aqiqah</span>
                        </li>
                    </ul>
                    <a href="{{ url('/order') }}" class="block text-center py-3 px-6 bg-secondary hover:bg-secondary-dark text-primary font-semibold rounded-lg transition duration-300">Pilih Paket</a>
                </div>
            </div>

            <!-- Paket Tasyakuran -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform hover:-translate-y-1 hover:shadow-xl">
                <div class="bg-primary p-6 text-center">
                    <h2 class="text-2xl font-bold text-white">Paket Tasyakuran</h2>
                    <p class="text-secondary-light font-medium mt-1">Economic Package</p>
                </div>
                <div class="p-6">
                    <div class="text-center mb-8">
                        <span class="text-4xl font-bold text-gray-800 dark:text-white">Rp1.600.000</span>
                        <p class="text-gray-500 dark:text-gray-400">per ekor</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Kambing ekonomis (22-25kg)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Menu masakan sederhana (2 jenis)</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Porsi 200-250 box</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 text-secondary mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-gray-700 dark:text-gray-300">Free sertifikat aqiqah</span>
                        </li>
                    </ul>
                    <a href="{{ url('/order') }}" class="block text-center py-3 px-6 bg-secondary hover:bg-secondary-dark text-primary font-semibold rounded-lg transition duration-300">Pilih Paket</a>
                </div>
            </div>
        </div>

        <div class="mt-16 max-w-4xl mx-auto text-center bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold text-primary dark:text-secondary mb-6">Penting Diketahui</h2>
            <div class="text-left text-gray-700 dark:text-gray-300 space-y-4">
                <p>• Untuk pemesanan aqiqah, minimal dilakukan H-7 sebelum acara.</p>
                <p>• Harga tersebut sudah termasuk proses penyembelihan sesuai syariat, pengolahan, dan pengiriman.</p>
                <p>• Free pengiriman untuk area dalam kota. Untuk pengiriman luar kota akan dikenakan biaya tambahan.</p>
                <p>• Pembayaran dapat dilakukan dengan transfer ke rekening resmi Nurul Hayat atau tunai di kantor kami.</p>
                <p>• Untuk pemesanan dan informasi lebih lanjut, silahkan hubungi customer service kami di nomor <span class="text-primary dark:text-secondary font-semibold">+62 812-3456-7890</span>.</p>
            </div>

            <div class="mt-8">
                <a href="{{ url('/order') }}" class="inline-block py-3 px-8 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg transition duration-300">Pesan Sekarang</a>
            </div>
        </div>
    </main>

    <footer class="bg-primary dark:bg-primary-dark text-white py-8 mt-12">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} Nurul Hayat Aqiqah. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>