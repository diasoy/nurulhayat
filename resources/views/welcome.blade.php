<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nurul Hayat</title>
    <meta name="description" content="Layanan Aqiqah terpercaya dari Nurul Hayat Surabaya. Proses hewan sesuai syariat, pengiriman tepat waktu, dan menu masakan berkualitas tinggi.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <link rel="icon" href="{{ asset('logo.jpg') }}" type="image/x-icon">

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
                        <a href="#hero" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-secondary transition">Home</a>
                        <a href="{{ url('/harga') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-secondary transition">Harga</a>
                        <a href="{{ url('/order') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-secondary transition">Order</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <section id="hero" class="relative py-12 md:py-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-center">
                <div class="mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white mb-6">
                        Aqiqah Berkah <span class="text-primary dark:text-secondary">Tepat Waktu</span>
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                        Layanan aqiqah terbaik dengan jaminan proses sesuai syariat Islam. Daging berkualitas, olahan lezat, dan pengiriman tepat waktu ke lokasi Anda.
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ url('/harga') }}" class="bg-primary hover:bg-primary-dark text-white px-8 py-4 rounded-lg text-center font-semibold transition duration-300">
                            Lihat Paket
                        </a>
                        <a href="#contact" class="border border-primary text-white hover:bg-primary-light/10 dark:hover:bg-primary-dark px-8 py-4 rounded-lg text-center font-semibold transition duration-300">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="alasan" class="py-16 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Mengapa Memilih Aqiqah Nurul Hayat?</h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Kami berkomitmen memberikan layanan aqiqah terbaik dengan proses yang sesuai syariat dan kualitas yang terjamin</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 shadow-md">
                    <div class="w-14 h-14 bg-secondary/20 dark:bg-secondary-dark/30 rounded-full flex items-center justify-center mb-4 text-secondary dark:text-secondary-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Sesuai Syariat</h3>
                    <p class="text-gray-600 dark:text-gray-300">Penyembelihan hewan aqiqah dilakukan sesuai dengan syariat Islam dan ditangani oleh ahli yang berpengalaman.</p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 shadow-md">
                    <div class="w-14 h-14 bg-secondary/20 dark:bg-secondary-dark/30 rounded-full flex items-center justify-center mb-4 text-secondary dark:text-secondary-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Tepat Waktu</h3>
                    <p class="text-gray-600 dark:text-gray-300">Kami menjamin pengiriman aqiqah tepat waktu sesuai dengan jadwal yang telah disepakati.</p>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 shadow-md">
                    <div class="w-14 h-14 bg-secondary/20 dark:bg-secondary-dark/30 rounded-full flex items-center justify-center mb-4 text-secondary dark:text-secondary-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Masakan Lezat</h3>
                    <p class="text-gray-600 dark:text-gray-300">Daging aqiqah diolah dengan resep spesial oleh juru masak berpengalaman dengan cita rasa yang lezat.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="testimonial" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Apa Kata Pelanggan Kami</h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Testimoni dari pelanggan yang telah menggunakan layanan aqiqah Nurul Hayat</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-primary-light/20 flex items-center justify-center text-xl font-bold text-primary">A</div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Ahmad Fauzi</h4>
                            <div class="flex text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">"Alhamdulillah, sangat puas dengan layanan aqiqah dari Nurul Hayat. Pengiriman tepat waktu dan masakan sangat lezat. Tamu-tamu kami juga memuji cita rasanya yang nikmat."</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-primary-light/20 flex items-center justify-center text-xl font-bold text-primary">S</div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Siti Nurhaliza</h4>
                            <div class="flex text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">"Terima kasih Nurul Hayat atas pelayanan yang sangat profesional. Petugas yang ramah dan proses aqiqah yang sesuai syariat membuat kami sangat terkesan."</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="h-12 w-12 rounded-full bg-primary-light/20 flex items-center justify-center text-xl font-bold text-primary">R</div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Rudi Hartono</h4>
                            <div class="flex text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">"Sudah dua kali menggunakan jasa aqiqah Nurul Hayat dan tidak pernah mengecewakan. Harga terjangkau dengan kualitas premium. Sangat direkomendasikan."</p>
                </div>
            </div>
        </div>
    </section>
    <section id="about" class="py-16 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Tentang Kami</h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Nurul Hayat Aqiqah adalah penyedia layanan aqiqah profesional dan terpercaya di Surabaya. Kami berkomitmen untuk membantu Anda menjalankan ibadah aqiqah sesuai syariat Islam dengan mudah dan praktis.</p>
            </div>
            <div class="flex flex-col md:flex-row items-center justify-center gap-8">
                <div class="md:w-1/2">
                    <img src="{{ asset('logo.jpg') }}" alt="Tentang Nurul Hayat Aqiqah" class="w-full h-auto rounded-lg shadow-lg">
                </div>
                <div class="md:w-1/2 text-gray-700 dark:text-gray-300">
                    <p class="mb-4">Sejak didirikan, Nurul Hayat Aqiqah telah melayani ribuan keluarga dengan sepenuh hati. Kami memahami pentingnya ibadah aqiqah bagi umat Muslim, oleh karena itu setiap proses mulai dari pemilihan hewan, penyembelihan, hingga pengolahan dan pengiriman dilakukan dengan standar kualitas tertinggi dan sesuai tuntunan syariat.</p>
                    <p>Kepuasan pelanggan adalah prioritas kami. Dengan tim yang berpengalaman dan profesional, kami siap membantu Anda mewujudkan acara aqiqah yang berkesan dan penuh berkah. Percayakan kebutuhan aqiqah Anda kepada Nurul Hayat.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="contact" class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">Hubungi Kami</h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Silakan hubungi kami untuk informasi lebih lanjut atau pemesanan layanan aqiqah</p>
            </div>

            <div class="flex flex-col md:flex-row gap-8">

                <div class="md:w-1/2 mx-auto">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md h-full">
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Alamat</h4>
                                    <p class="text-gray-600 dark:text-gray-300">Jl. Raya Pasar Minggu No.123, Jakarta Selatan, Indonesia</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Telepon</h4>
                                    <p class="text-gray-600 dark:text-gray-300">+62 812-3456-7890</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary mt-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Email</h4>
                                    <p class="text-gray-600 dark:text-gray-300">info@nurulhayat.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-primary dark:bg-primary-dark text-white py-8 ">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} Nurul Hayat Aqiqah. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>