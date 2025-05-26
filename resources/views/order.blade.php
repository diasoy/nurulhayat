<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Form Pemesanan Aqiqah Nurul Hayat</title>
    <meta name="description" content="Isi form pemesanan aqiqah online Nurul Hayat Surabaya dengan mudah dan cepat.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-jHWV-gx1oyKlK2OE"></script>

</head>

<body class="antialiased bg-gradient-to-br from-primary-light/10 to-white dark:from-primary-dark dark:to-gray-900 min-h-screen">
    <header class="relative">
        <nav class="container mx-auto px-6 py-4 shadow-md ">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="py-4 mr-20">
                        <span class="text-2xl font-bold text-primary dark:text-secondary">Nurul Hayat</span>
                    </div>
                    <div class="hidden md:flex space-x-6">
                        <a href="{{ url('/') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-secondary transition">Home</a>
                        <a href="{{ url('/harga') }}" class="text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-secondary transition">Harga</a>
                        <a href="#top" class="text-primary dark:text-secondary transition">Order</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-6 py-12" id="top">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 dark:text-white text-center mb-12">Form Pemesanan Aqiqah</h1>

        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-8" role="alert">
            <p class="font-bold">Informasi Penting:</p>
            <p>
                Harga total pemesanan terdiri dari <b>harga paket kambing aqiqah (masak)</b> <u>ditambah</u> <b>harga paket kotakan</b> (nasi kotak).
                Anda dapat memilih tipe kambing dan jumlahnya, lalu tentukan jumlah kotakan sesuai kebutuhan.
                <br>
                <b>Total pembayaran = Harga kambing aqiqah + Harga kotakan</b>
            </p>
            <ul class="mt-2 list-disc pl-5 text-sm">
                <li>Harga kotakan: Rp 20.000 per kotak (sudah termasuk nasi, lauk, buah, alat makan, dan box eksklusif).</li>
                <li>Jumlah maksimal kotakan mengikuti tipe kambing yang dipilih.</li>
                <li>Paket Tasyakuran <b>belum sah digunakan untuk aqiqah</b>.</li>
            </ul>
        </div>

        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md max-w-3xl mx-auto">
            <p class="text-gray-600 dark:text-gray-300 mb-8 text-center">Silakan isi form pemesanan di bawah ini dengan benar, agar kami dapat membantu proses aqiqah Anda.</p>

            <form id="orderForm" action="#" method="POST" class="space-y-6" onsubmit="return handleOrderSubmit(event)">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Data Pemesan</h2>
                <div>
                    <label for="pemesan_nama" class="block text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap:</label>
                    <input type="text" id="pemesan_nama" name="pemesan_nama" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Masukkan nama lengkap pemesan" required>
                </div>
                <div>
                    <label for="pemesan_alamat" class="block text-gray-700 dark:text-gray-300 mb-2">Alamat:</label>
                    <textarea id="pemesan_alamat" name="pemesan_alamat" rows="3" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Masukkan alamat lengkap pemesan" required></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="pemesan_telepon" class="block text-gray-700 dark:text-gray-300 mb-2">Nomor Telepon (Rumah/Kantor):</label>
                        <input type="tel" id="pemesan_telepon" name="pemesan_telepon" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Cth: (031) 123456">
                    </div>
                    <div>
                        <label for="pemesan_handphone" class="block text-gray-700 dark:text-gray-300 mb-2">Nomor Handphone:</label>
                        <input type="tel" id="pemesan_handphone" name="pemesan_handphone" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Cth: +6281234567890" required>
                    </div>
                </div>
                <div>
                    <label for="pemesan_email" class="block text-gray-700 dark:text-gray-300 mb-2">Email:</label>
                    <input type="email" id="pemesan_email" name="pemesan_email" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Masukkan alamat email" required>
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Data Yang Akan Di Aqiqah</h2>
                <div>
                    <label for="aqiqoh_nama" class="block text-gray-700 dark:text-gray-300 mb-2">Nama Lengkap:</label>
                    <input type="text" id="aqiqoh_nama" name="aqiqoh_nama" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Nama anak yang akan di aqiqah" required>
                </div>
                <div>
                    <label for="aqiqoh_binbinti" class="block text-gray-700 dark:text-gray-300 mb-2">Bin/Binti:</label>
                    <input type="text" id="aqiqoh_binbinti" name="aqiqoh_binbinti" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Cth: bin Abdullah / binti Fatimah" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="aqiqoh_tempat_lahir" class="block text-gray-700 dark:text-gray-300 mb-2">Tempat Lahir:</label>
                        <input type="text" id="aqiqoh_tempat_lahir" name="aqiqoh_tempat_lahir" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Cth: Surabaya" required>
                    </div>
                    <div>
                        <label for="aqiqoh_tanggal_lahir" class="block text-gray-700 dark:text-gray-300 mb-2">Tanggal Lahir:</label>
                        <input type="date" id="aqiqoh_tanggal_lahir" name="aqiqoh_tanggal_lahir" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" required>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Jenis Kelamin:</label>
                    <div class="flex items-center space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="aqiqoh_jenis_kelamin" value="Laki-laki" class="form-radio text-primary" required>
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Laki-laki</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="aqiqoh_jenis_kelamin" value="Perempuan" class="form-radio text-primary" required>
                            <span class="ml-2 text-gray-700 dark:text-gray-300">Perempuan</span>
                        </label>
                    </div>
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Pelaksanaan Ibadah Aqiqah</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="pelaksanaan_hari" class="block text-gray-700 dark:text-gray-300 mb-2">Hari:</label>
                        <input type="text" id="pelaksanaan_hari" name="pelaksanaan_hari" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Cth: Minggu" required>
                    </div>
                    <div>
                        <label for="pelaksanaan_tanggal" class="block text-gray-700 dark:text-gray-300 mb-2">Tanggal:</label>
                        <input type="date" id="pelaksanaan_tanggal" name="pelaksanaan_tanggal" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" required>
                    </div>
                    <div>
                        <label for="pelaksanaan_jam" class="block text-gray-700 dark:text-gray-300 mb-2">Jam:</label>
                        <input type="time" id="pelaksanaan_jam" name="pelaksanaan_jam" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" required>
                    </div>
                </div>
                <div>
                    <label for="pelaksanaan_alamat" class="block text-gray-700 dark:text-gray-300 mb-2">Alamat Pengiriman:</label>
                    <textarea id="pelaksanaan_alamat" name="pelaksanaan_alamat" rows="3" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" placeholder="Alamat lengkap untuk pengiriman aqiqah" required></textarea>
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Detail Aqiqah</h2>
                <div>
                    <label for="type_aqiqah" class="block text-gray-700 dark:text-gray-300 mb-2">Pilih Tipe Aqiqah:</label>
                    <select id="type_aqiqah" name="type_aqiqah" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" required onchange="updateAqiqahDetails()">
                        <option value="">-- Pilih Aqiqah --</option>
                        <option value="PLATINUM">PLATINUM</option>
                        <option value="ISTIMEWA">ISTIMEWA</option>
                        <option value="SUPER">SUPER</option>
                        <option value="PUAS">PUAS</option>
                        <option value="TASYAKURAN">TASYAKURAN</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" id="aqiqah-options" style="display: none;">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 mb-2">Jenis Kambing:</label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="animal_gender" value="Jantan" class="form-radio text-primary" onchange="updateAqiqahDetails()">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Jantan</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="animal_gender" value="Betina" class="form-radio text-primary" onchange="updateAqiqahDetails()">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Betina</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 mb-2">Pilihan Menu:</label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="menu_option" value="3 Menu" class="form-radio text-primary" onchange="updateAqiqahDetails()">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">3 Menu</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="menu_option" value="2 Menu" class="form-radio text-primary" onchange="updateAqiqahDetails()">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">2 Menu</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div id="aqiqah-quantities" class="space-y-0">
                        <div id="quantity_platinum_div" style="display: none;">
                            <label for="quantity_platinum" class="block text-gray-700 dark:text-gray-300 mb-2">Jumlah Kambing Platinum:</label>
                            <input type="number" id="quantity_platinum" name="quantity_platinum" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" value="0" min="0" onchange="updateAqiqahDetails()">
                        </div>
                        <div id="quantity_istimewa_div" style="display: none;">
                            <label for="quantity_istimewa" class="block text-gray-700 dark:text-gray-300 mb-2">Jumlah Kambing Istimewa:</label>
                            <input type="number" id="quantity_istimewa" name="quantity_istimewa" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" value="0" min="0" onchange="updateAqiqahDetails()">
                        </div>
                        <div id="quantity_super_div" style="display: none;">
                            <label for="quantity_super" class="block text-gray-700 dark:text-gray-300 mb-2">Jumlah Kambing Super:</label>
                            <input type="number" id="quantity_super" name="quantity_super" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" value="0" min="0" onchange="updateAqiqahDetails()">
                        </div>
                        <div id="quantity_puas_div" style="display: none;">
                            <label for="quantity_puas" class="block text-gray-700 dark:text-gray-300 mb-2">Jumlah Kambing Puas:</label>
                            <input type="number" id="quantity_puas" name="quantity_puas" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" value="0" min="0" onchange="updateAqiqahDetails()">
                        </div>
                        <div id="quantity_tasyakuran_div" style="display: none;">
                            <label for="quantity_tasyakuran" class="block text-gray-700 dark:text-gray-300 mb-2">Jumlah Kambing Tasyakuran:</label>
                            <input type="number" id="quantity_tasyakuran" name="quantity_tasyakuran" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" value="0" min="0" onchange="updateAqiqahDetails()">
                        </div>
                    </div>
                    <div id="kotakan_div" style="display: none;">
                        <label for="jumlah_kotakan" class="block text-gray-700 dark:text-gray-300 mb-2 mt-6 md:mt-0">Jumlah Kotakan (Nasi Kotak):</label>
                        <input type="number" id="jumlah_kotakan" name="jumlah_kotakan" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white" value="0" min="0" onchange="updateAqiqahDetails()">
                        <p id="kotakan_max_info" class="text-sm text-gray-500 dark:text-gray-400 mt-1"></p>
                    </div>
                </div>

                <div id="aqiqah-summary" class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg mt-8" style="display: none;">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Ringkasan Pesanan Anda:</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Tipe Aqiqah: <span id="summary_type_aqiqah" class="font-semibold"></span></p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Jenis Kambing: <span id="summary_animal_gender" class="font-semibold"></span></p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Jumlah Kambing: <span id="summary_quantity" class="font-semibold"></span></p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Pilihan Menu: <span id="summary_menu_option" class="font-semibold"></span></p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Detail Menu: <span id="summary_menu_details" class="font-semibold"></span></p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Jumlah Kotak: <span id="summary_box_count" class="font-semibold"></span></p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Harga Kambing: <span id="summary_price_kambing" class="font-semibold"></span></p>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Harga Kotakan: <span id="summary_price_kotakan" class="font-semibold"></span></p>
                    <p class="text-gray-800 dark:text-white text-2xl font-bold mt-4">Total Harga: <span id="summary_price">Rp0</span></p>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-4 px-6 rounded-lg transition duration-300 text-xl">Kirim Pemesanan</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="bg-primary dark:bg-primary-dark text-white py-8 mt-12">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} Nurul Hayat Aqiqah. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const aqiqahData = {
            "PLATINUM": {
                "Jantan": 3980000,
                "Betina": 3130000,
                "3 Menu": {
                    "details": "270 sate + 90 kreng daging + 180 gule jeroan tulang",
                    "price_add": 75000,
                    "boxes": 90
                },
                "2 Menu": {
                    "details": "550 sate + 180 gule",
                    "price_add": 0,
                    "boxes": 180
                }
            },
            "ISTIMEWA": {
                "Jantan": 3630000,
                "Betina": 2780000,
                "3 Menu": {
                    "details": "210 sate + 70 kreng daging + 140 gule jeroan tulang",
                    "price_add": 75000,
                    "boxes": 70
                },
                "2 Menu": {
                    "details": "450 sate + 140 gule",
                    "price_add": 0,
                    "boxes": 140
                }
            },
            "SUPER": {
                "Jantan": 2850000,
                "Betina": 2300000,
                "3 Menu": {
                    "details": "150 sate + 50 kreng daging + 100 gule jeroan tulang",
                    "price_add": 0,
                    "boxes": 50
                },
                "2 Menu": {
                    "details": "300 sate + 100 gule",
                    "price_add": 0,
                    "boxes": 100
                }
            },
            "PUAS": {
                "Jantan": 2700000,
                "Betina": 2050000,
                "3 Menu": {
                    "details": "120 sate + 40 kreng daging + 80 gule",
                    "price_add": 0,
                    "boxes": 40
                },
                "2 Menu": {
                    "details": "250 sate + 80 gule",
                    "price_add": 0,
                    "boxes": 80
                }
            },
            "TASYAKURAN": {
                "Betina": 1850000,
                "2 Menu": {
                    "details": "150 sate + 40 gule",
                    "price_add": 0,
                    "boxes": null // Tasyakuran does not specify box count in your data
                }
            }
        };

        const kotakanPrice = 20000;

        function updateAqiqahDetails() {
            const selectedType = document.getElementById('type_aqiqah').value;
            const quantityDivs = {
                'PLATINUM': document.getElementById('quantity_platinum_div'),
                'ISTIMEWA': document.getElementById('quantity_istimewa_div'),
                'SUPER': document.getElementById('quantity_super_div'),
                'PUAS': document.getElementById('quantity_puas_div'),
                'TASYAKURAN': document.getElementById('quantity_tasyakuran_div')
            };

            const aqiqahOptionsDiv = document.getElementById('aqiqah-options');
            const aqiqahSummaryDiv = document.getElementById('aqiqah-summary');
            const kotakanDiv = document.getElementById('kotakan_div');
            const kotakanInput = document.getElementById('jumlah_kotakan');
            const kotakanMaxInfo = document.getElementById('kotakan_max_info');

            // Hide all quantity inputs (jangan reset nilainya!)
            for (const type in quantityDivs) {
                quantityDivs[type].style.display = 'none';
            }

            // Hide options, kotakan, and summary by default
            aqiqahOptionsDiv.style.display = 'none';
            aqiqahSummaryDiv.style.display = 'none';
            kotakanDiv.style.display = 'none';
            kotakanInput.value = 0;
            kotakanMaxInfo.textContent = '';

            // Reset summary fields
            document.getElementById('summary_type_aqiqah').textContent = '';
            document.getElementById('summary_animal_gender').textContent = '';
            document.getElementById('summary_quantity').textContent = '';
            document.getElementById('summary_menu_option').textContent = '';
            document.getElementById('summary_menu_details').textContent = '';
            document.getElementById('summary_box_count').textContent = '';
            document.getElementById('summary_price_kambing').textContent = '';
            document.getElementById('summary_price_kotakan').textContent = '';
            document.getElementById('summary_price').textContent = 'Rp0';

            // If an Aqiqah type is selected
            if (selectedType) {
                // Show the relevant quantity input
                quantityDivs[selectedType].style.display = 'block';
                const quantityInput = quantityDivs[selectedType].querySelector('input');
                if (quantityInput.value === '0' || quantityInput.value === '') {
                    quantityInput.value = 1;
                }

                // Show animal gender and menu options
                aqiqahOptionsDiv.style.display = 'grid';


                // Handle TASYAKURAN specific logic (only Betina, only 2 Menu)
                if (selectedType === 'TASYAKURAN') {
                    document.querySelector('input[name="animal_gender"][value="Jantan"]').checked = false;
                    document.querySelector('input[name="animal_gender"][value="Jantan"]').disabled = true;
                    document.querySelector('input[name="animal_gender"][value="Betina"]').checked = true;
                    document.querySelector('input[name="animal_gender"][value="Betina"]').disabled = false;

                    document.querySelector('input[name="menu_option"][value="3 Menu"]').checked = false;
                    document.querySelector('input[name="menu_option"][value="3 Menu"]').disabled = true;
                    document.querySelector('input[name="menu_option"][value="2 Menu"]').checked = true;
                    document.querySelector('input[name="menu_option"][value="2 Menu"]').disabled = false;
                } else {
                    document.querySelector('input[name="animal_gender"][value="Jantan"]').disabled = false;
                    document.querySelector('input[name="animal_gender"][value="Betina"]').disabled = false;
                    document.querySelector('input[name="menu_option"][value="3 Menu"]').disabled = false;
                    document.querySelector('input[name="menu_option"][value="2 Menu"]').disabled = false;
                }

                const selectedAnimalGender = document.querySelector('input[name="animal_gender"]:checked')?.value;
                const selectedMenuOption = document.querySelector('input[name="menu_option"]:checked')?.value;
                const quantity = parseInt(quantityInput.value);

                // Show kotakan input if menu & gender selected
                if (selectedAnimalGender && selectedMenuOption && quantity > 0) {
                    // Show kotakan input
                    kotakanDiv.style.display = 'block';

                    // Get max kotakan
                    let maxKotakan = 0;
                    if (
                        aqiqahData[selectedType] &&
                        aqiqahData[selectedType][selectedMenuOption] &&
                        aqiqahData[selectedType][selectedMenuOption].boxes !== null
                    ) {
                        maxKotakan = aqiqahData[selectedType][selectedMenuOption].boxes * quantity;
                        kotakanInput.max = maxKotakan;
                        kotakanMaxInfo.textContent = `Maksimal kotakan: ${maxKotakan} kotak`;
                    } else {
                        kotakanInput.max = '';
                        kotakanMaxInfo.textContent = 'Jumlah kotakan tidak tersedia untuk tipe ini.';
                    }
                    if (kotakanInput.value === '0') {
                        kotakanInput.value = maxKotakan;
                    }

                    // Calculate price and update summary if all selections are made
                    let basePrice = 0;
                    let menuDetails = '';
                    let menuAddPrice = 0;
                    let boxCount = 0;

                    if (aqiqahData[selectedType] && aqiqahData[selectedType][selectedAnimalGender]) {
                        basePrice = aqiqahData[selectedType][selectedAnimalGender];
                    }

                    if (aqiqahData[selectedType] && aqiqahData[selectedType][selectedMenuOption]) {
                        menuDetails = aqiqahData[selectedType][selectedMenuOption].details;
                        menuAddPrice = aqiqahData[selectedType][selectedMenuOption].price_add;
                        boxCount = aqiqahData[selectedType][selectedMenuOption].boxes;
                    }

                    const totalKambingPrice = (basePrice + menuAddPrice) * quantity;
                    const jumlahKotakan = parseInt(kotakanInput.value) || 0;
                    const totalKotakanPrice = jumlahKotakan * kotakanPrice;
                    const totalPrice = totalKambingPrice + totalKotakanPrice;

                    aqiqahSummaryDiv.style.display = 'block';
                    document.getElementById('summary_type_aqiqah').textContent = selectedType;
                    document.getElementById('summary_animal_gender').textContent = selectedAnimalGender;
                    document.getElementById('summary_quantity').textContent = quantity;
                    document.getElementById('summary_menu_option').textContent = selectedMenuOption;
                    document.getElementById('summary_menu_details').textContent = menuDetails;
                    document.getElementById('summary_box_count').textContent = boxCount !== null ? `${boxCount * quantity} kotak` : 'Tidak tersedia';
                    document.getElementById('summary_price_kambing').textContent = `Rp${totalKambingPrice.toLocaleString('id-ID')}`;
                    document.getElementById('summary_price_kotakan').textContent = `Rp${totalKotakanPrice.toLocaleString('id-ID')}`;
                    document.getElementById('summary_price').textContent = `Rp${totalPrice.toLocaleString('id-ID')}`;
                }
            }
        }
        document.addEventListener('DOMContentLoaded', updateAqiqahDetails);
        // Update summary when kotakan input changes
        document.addEventListener('input', function(e) {
            if (e.target && e.target.id === 'jumlah_kotakan') {
                updateAqiqahDetails();
            }
        });

        function handleOrderSubmit(event) {
            event.preventDefault();

            // Ambil data form
            const form = document.getElementById('orderForm');
            const formData = new FormData(form);

            formData.append('summary_total', document.getElementById('summary_price').textContent.replace(/[^\d]/g, ''));

            fetch('/midtrans/token', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.snap_token) {
                        window.snap.pay(data.snap_token, {
                            onSuccess: function(result) {
                                fetch('/order/update-status', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        order_id: result.order_id,
                                        transaction_status: result.transaction_status,
                                        payment_type: result.payment_type,
                                        va_number: result.va_numbers ? result.va_numbers[0].va_number : null,
                                        midtrans_raw: JSON.stringify(result)
                                    })
                                }).then(() => {
                                    window.location.href = '/order/success';
                                });
                            },
                            onPending: function(result) {
                                window.location.href = '/order/pending';
                            },
                            onError: function(result) {
                                alert('Pembayaran gagal!');
                            }
                        });
                    } else {
                        alert('Gagal memproses pembayaran.');
                    }
                })
                .catch(() => alert('Gagal terhubung ke server.'));
            return false;
        }
    </script>
</body>

</html>