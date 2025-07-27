<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIP Room Experience - PS Rental Zone</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}"> <!-- Tambahkan baris ini -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            background-color: #fde2f3;
            /* Light Pink Background */
        }

        .navbar-bg {
            background-color: #1a1a1a;
            /* Dark/Black Navbar */
        }

        .button-pink {
            background-color: #f72585;
            /* Hot Pink Button */
            color: white;
        }

        .button-pink:hover {
            background-color: #d01f6d;
            /* Darker Pink on Hover */
        }

        .card-bg {
            background-color: #ffffff;
            /* White Card Background */
        }

        .text-pink-accent {
            color: #f72585;
            /* Hot Pink for Accents */
        }

        .text-black-accent {
            color: #1a1a1a;
            /* Black for Accents */
        }

        .section-title {
            font-size: 2.5rem;
            /* 40px */
            font-weight: bold;
            text-align: center;
            margin-bottom: 3rem;
            /* 48px */
            color: #1a1a1a;
            /* text-black-accent */
        }

        .vip-hero-bg {
            background-image: url('https://source.unsplash.com/1600x900/?luxury,gaming,vip,lounge');
            background-size: cover;
            background-position: center;
        }

        .hamburger-icon {
            transition: all 0.5s ease-in-out;
            transform-origin: center;
        }

        .hamburger-active .hamburger-icon {
            animation: gamepadWiggle 1s ease-in-out infinite;
            color: #f72585;
        }

        @keyframes gamepadWiggle {
            0% {
                transform: rotate(0deg) scale(1);
            }

            25% {
                transform: rotate(-15deg) scale(1.2);
            }

            50% {
                transform: rotate(0deg) scale(1);
            }

            75% {
                transform: rotate(15deg) scale(1.2);
            }

            100% {
                transform: rotate(0deg) scale(1);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar-bg p-4 sticky top-0 z-50 shadow-lg bg-blue-700">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="index.html" class="text-white text-2xl font-bold flex items-center">
                <img src="{{ asset('image/logo.png') }}" alt="PS Rental Zone Logo" class="h-10 mr-2" />
                PS Rental Zone
            </a>

            <!-- Tombol Hamburger untuk Mobile -->
            <button id="hamburgerBtn" class="md:hidden text-white focus:outline-none p-2 flex items-center">
                <i class="ri-gamepad-line text-2xl hamburger-icon"></i>
            </button>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center space-x-6">
                <!-- Dropdown Menu -->
                <div class="relative">
                    <button id="menuButton" class="text-white hover:text-pink-300 flex items-center">
                        Menu
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="menuDropdown"
                        class="hidden absolute w-48 bg-white rounded-lg shadow-xl py-2 mt-2 -left-4 z-50">
                        <a href="#home" class="block px-4 py-2 text-gray-800 hover:bg-pink-100">Beranda</a>
                        <a href="#about" class="block px-4 py-2 text-gray-800 hover:bg-pink-100">Tentang Kami</a>
                        <a href="#services" class="block px-4 py-2 text-gray-800 hover:bg-pink-100">Layanan</a>
                        <a href="#contact" class="block px-4 py-2 text-gray-800 hover:bg-pink-100">Kontak</a>
                    </div>
                </div>

                <!-- Menu Tautan -->
                <a href="{{ route('booking.form') }}" class="text-white hover:text-pink-300">Pesan</a>
                <a href="{{ route('jadwal.form') }}" class="text-white hover:text-pink-300">Jadwal</a>
                <a href="{{ route('vip.form') }}" class="text-white hover:text-pink-300">Catalog</a>

                <!-- User -->
                <div class="relative">
                    @csrf
                    <button id="menuButton1" class="flex items-center space-x-2 cursor-pointer">
                        <img src="{{ $user->foto ? asset('storage/foto/' . $user->foto) : asset('image/default-user.png') }}"
                            alt="Foto Profil"
                            class="w-8 h-8 rounded-full object-cover border border-gray-300" />
                        <svg class="w-4 h-4 text-white ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="menuDropdown1" class="hidden absolute w-48 bg-white rounded-lg shadow-xl py-2 mt-2 -left-4 z-50">
                        <a href="{{route('profile')}}" class="block px-4 py-2 text-gray-800 hover:bg-pink-100">Profil</a>
                        <a href="{{route('riwayat.user')}}" class="block px-4 py-2 text-gray-800 hover:bg-pink-100">Pesanan</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600 font-medium">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden hidden px-4 pt-2 pb-4" id="mobileMenu">
            <div class="space-y-2">
                <!-- Menu Utama -->
                <div class="space-y-1">
                    <a href="#home" class="block py-2 px-4 text-white hover:text-pink-300">Beranda</a>
                    <a href="#about" class="block py-2 px-4 text-white hover:text-pink-300">Tentang Kami</a>
                    <a href="#services" class="block py-2 px-4 text-white hover:text-pink-300">Layanan</a>
                    <a href="{{ route('booking.form') }}" class="block py-2 px-4 text-white hover:text-pink-300">Pesan</a>
                    <a href="{{ route('jadwal.form') }}" class="block py-2 px-4 text-white hover:text-pink-300">Jadwal</a>
                    <a href="{{ route('vip.form') }}" class="block py-2 px-4 text-white hover:text-pink-300">Catalog</a>
                    <a href="#contact" class="block py-2 px-4 text-white hover:text-pink-300">Kontak</a>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600 font-medium">
                        Logout
                    </button>
                </form>
            </div>
        </div>
        </div>
    </nav>

    <!-- VIP Hero Section -->
    <section class="vip-hero-bg text-white py-24">
        <div class="container mx-auto text-center bg-black bg-opacity-60 p-10 rounded-lg">
            <h1 class="text-5xl font-bold mb-4">The Ultimate VIP Gaming Experience</h1>
            <p class="text-xl mb-8">Rasakan kemewahan dan kenyamanan tak tertandingi di VIP Room kami.</p>
        </div>
    </section>

    <!-- VIP Room Details Section -->
    <section class="container mx-auto py-16 px-4">
        <h2 class="section-title text-black-accent">Detail VIP Premium (All Access)</h2>
        <div class="grid md:grid-cols-2 gap-12 items-start">
            <div>
                <div class="grid grid-cols-1 gap-6">
                    <img
                        src="{{ asset('image/vip_interion.jpeg') }}"
                        alt="VIP Room Interior"
                        class="w-full h-[400px] object-cover rounded-lg shadow-xl">
                    <img
                        src="{{ asset('image/vip_setup.jpeg') }}"
                        alt="VIP Room Setup"
                        class="w-full h-[400px] object-cover rounded-lg shadow-xl">
                </div>
            </div>
            <div class="card-bg p-8 rounded-lg shadow-2xl">
                <h3 class="text-3xl font-bold mb-4 text-pink-accent">Fasilitas Eksklusif:</h3>
                <ul class="mb-6 space-y-3 text-gray-700 text-lg">
                    <li><i class="fas fa-crown text-pink-500 mr-3"></i>Konsol PS5 Terbaru + PlayStation VR2 Set</li>
                    <li><i class="fas fa-couch text-pink-500 mr-3"></i>Sofa Kulit Premium Ergonomis & Bean Bags Mewah</li>
                    <li><i class="fas fa-snowflake text-pink-500 mr-3"></i>AC Dingin Maksimal dengan Air Purifier</li>
                    <li><i class="fas fa-tv text-pink-500 mr-3"></i>TV OLED 4K 77 inch dengan Refresh Rate Tinggi</li>
                    <li><i class="fas fa-volume-up text-pink-500 mr-3"></i>Sound System Dolby Atmos Imersif</li>
                    <li><i class="fas fa-cookie-bite text-pink-500 mr-3"></i>Pilihan Snack & Minuman Premium (Gratis)</li>
                    <li><i class="fas fa-concierge-bell text-pink-500 mr-3"></i>Layanan Personal & Bantuan Teknis Prioritas</li>
                    <li><i class="fas fa-wifi text-pink-500 mr-3"></i>Akses Internet Kecepatan Tinggi Khusus</li>
                    <li><i class="fas fa-gamepad text-pink-500 mr-3"></i>Akses ke Seluruh Pustaka Game Digital Kami</li>
                    <li><i class="fas fa-door-closed text-pink-500 mr-3"></i>Privasi Maksimal dan Suasana Eksklusif</li>
                </ul>
                <p class="text-3xl font-bold mb-6 text-black-accent">Harga: Rp 100.000/jam</p>
                <p class="text-gray-600 mb-6">VIP Room kami dirancang untuk memberikan pengalaman gaming yang paling mewah dan tak terlupakan. Cocok untuk sesi gaming spesial, streaming, atau sekadar memanjakan diri.</p>
                <button onclick="window.location.href='/pesan'" class="button-pink w-full px-8 py-4 rounded-full text-xl font-semibold transition-transform transform hover:scale-105">Pesan VIP Room Sekarang!</button>
            </div>
        </div>
    </section>

    <!-- VIP Room Options Section -->
    <section class="container mx-auto py-16 px-4">
        <h2 class="section-title text-black-accent">Pilihan Ruangan VIP Eksklusif Kami</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

            <!-- VIP Silver Package -->
            <div class="card-bg p-6 rounded-lg shadow-xl transform hover:scale-105 transition-transform duration-300 flex flex-col">
                <img src="{{ asset('image/vip_silver_room.jpeg') }}" alt="VIP Silver Room" class="w-full h-48 object-cover rounded-md mb-4">
                <h3 class="text-2xl font-bold mb-3 text-pink-accent">VIP Silver Access</h3>
                <ul class="mb-4 space-y-2 text-gray-700 text-md flex-grow">
                    <li><i class="fas fa-check-circle text-pink-500 mr-2"></i>Konsol PS5 Standard</li>
                    <li><i class="fas fa-check-circle text-pink-500 mr-2"></i>TV Full HD 50 inch</li>
                    <li><i class="fas fa-check-circle text-pink-500 mr-2"></i>Kursi Gaming Nyaman</li>
                    <li><i class="fas fa-check-circle text-pink-500 mr-2"></i>Akses ke Pustaka Game Populer</li>
                    <li><i class="fas fa-check-circle text-pink-500 mr-2"></i>Minuman Ringan Gratis (1x)</li>
                </ul>
                <p class="text-2xl font-bold mb-4 text-black-accent">Harga: Rp 75.000/jam</p>
                <button onclick="window.location.href='/pesan'" class="button-pink w-full px-6 py-3 rounded-full text-lg font-semibold mt-auto">Pesan VIP Silver</button>
            </div>

            <!-- VIP Gold Package (Previously Premium) -->
            <div class="card-bg p-6 rounded-lg shadow-xl transform hover:scale-105 transition-transform duration-300 border-4 border-pink-500 flex flex-col">
                <div class="text-center mb-3">
                    <span class="bg-pink-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Paling Populer</span>
                </div>
                <img src="{{ asset('image/vip_gold_room.jpeg') }}" alt="VIP Gold Room" class="w-full h-48 object-cover rounded-md mb-4">
                <h3 class="text-2xl font-bold mb-3 text-pink-accent">VIP Gold Access</h3>
                <ul class="mb-4 space-y-2 text-gray-700 text-md flex-grow">
                    <li><i class="fas fa-crown text-pink-500 mr-2"></i>Konsol PS5 Terbaru + PlayStation VR2 Set</li>
                    <li><i class="fas fa-couch text-pink-500 mr-2"></i>Sofa Kulit Premium Ergonomis</li>
                    <li><i class="fas fa-snowflake text-pink-500 mr-2"></i>AC Dingin Maksimal + Air Purifier</li>
                    <li><i class="fas fa-tv text-pink-500 mr-2"></i>TV OLED 4K 65 inch HDR</li>
                    <li><i class="fas fa-volume-up text-pink-500 mr-2"></i>Sound System Surround</li>
                    <li><i class="fas fa-cookie-bite text-pink-500 mr-2"></i>Pilihan Snack & Minuman Premium</li>
                    <li><i class="fas fa-gamepad text-pink-500 mr-2"></i>Akses Penuh Pustaka Game Digital</li>
                </ul>
                <p class="text-2xl font-bold mb-4 text-black-accent">Harga: Rp 100.000/jam</p>
                <button onclick="window.location.href='/pesan'" class="button-pink w-full px-6 py-3 rounded-full text-lg font-semibold mt-auto">Pesan VIP Gold</button>
            </div>

            <!-- VIP Platinum Package -->
            <div class="card-bg p-6 rounded-lg shadow-xl transform hover:scale-105 transition-transform duration-300 flex flex-col">
                <img src="{{ asset('image/vip_platinum_room.jpeg') }}" alt="VIP Platinum Room" class="w-full h-48 object-cover rounded-md mb-4">
                <h3 class="text-2xl font-bold mb-3 text-pink-accent">VIP Platinum Suite</h3>
                <ul class="mb-4 space-y-2 text-gray-700 text-md flex-grow">
                    <li><i class="fas fa-gem text-pink-500 mr-2"></i>Dual Konsol PS5 Pro (jika tersedia)</li>
                    <li><i class="fas fa-vr-cardboard text-pink-500 mr-2"></i>Dual PlayStation VR2 Sets</li>
                    <li><i class="fas fa-chair text-pink-500 mr-2"></i>Kursi Gaming DXRacer & Sofa Mewah</li>
                    <li><i class="fas fa-broadcast-tower text-pink-500 mr-2"></i>Proyektor 4K 120 inch + TV OLED 77 inch</li>
                    <li><i class="fas fa-headset text-pink-500 mr-2"></i>Headset Gaming Profesional Nirkabel</li>
                    <li><i class="fas fa-concierge-bell text-pink-500 mr-2"></i>Layanan Personal Butler & Katering Mini</li>
                    <li><i class="fas fa-door-open text-pink-500 mr-2"></i>Akses Game Eksklusif & Early Access</li>
                </ul>
                <p class="text-2xl font-bold mb-4 text-black-accent">Harga: Rp 200.000/jam</p>
                <button onclick="window.location.href='/pesan'" class="button-pink w-full px-6 py-3 rounded-full text-lg font-semibold mt-auto">Pesan VIP Platinum</button>
            </div>
        </div>
    </section>

    <!-- Exclusive VIP Benefits Section -->
    <section class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="section-title text-white" style="color: white;">Keuntungan Eksklusif Anggota VIP</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <i class="fas fa-calendar-alt fa-3x mb-4 text-pink-500"></i>
                    <h3 class="text-xl font-semibold mb-2">Prioritas Booking</h3>
                    <p class="text-gray-400">Dapatkan slot waktu terbaik lebih dulu.</p>
                </div>
                <div class="p-6">
                    <i class="fas fa-gift fa-3x mb-4 text-pink-500"></i>
                    <h3 class="text-xl font-semibold mb-2">Bonus & Diskon</h3>
                    <p class="text-gray-400">Diskon khusus untuk game dan merchandise.</p>
                </div>
                <div class="p-6">
                    <i class="fas fa-trophy fa-3x mb-4 text-pink-500"></i>
                    <h3 class="text-xl font-semibold mb-2">Turnamen Eksklusif</h3>
                    <p class="text-gray-400">Akses ke kompetisi khusus anggota VIP.</p>
                </div>
                <div class="p-6">
                    <i class="fas fa-glass-cheers fa-3x mb-4 text-pink-500"></i>
                    <h3 class="text-xl font-semibold mb-2">Layanan Premium</h3>
                    <p class="text-gray-400">Minuman selamat datang dan layanan ekstra.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <p class="mb-2 text-lg">&copy; 2024 PS Rental Zone. All rights reserved.</p>
            <p class="text-sm">Your Ultimate Gaming Destination!</p>
        </div>
    </footer>

    <script>
        // Smooth scroll untuk navigasi internal (jika ada #link di halaman ini)
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                if (this.getAttribute('href') !== "#") {
                    const targetElement = document.querySelector(this.getAttribute('href'));
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        // Toggle hamburger menu
        // Update bagian hamburger menu toggle
        hamburgerBtn.addEventListener('click', () => {
            hamburgerBtn.classList.toggle('hamburger-active');
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('show');
        });

        // Tambahkan event listener untuk menutup menu saat mengklik di luar
        document.addEventListener('click', (event) => {
            if (!hamburgerBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                hamburgerBtn.classList.remove('hamburger-active');
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('show');
            }
        });

        // Menutup menu saat mengklik link
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => {
                hamburgerBtn.classList.remove('hamburger-active');
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('show');
            });
        });
    </script>
</body>

</html>