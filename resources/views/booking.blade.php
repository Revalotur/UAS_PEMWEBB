<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan - PS Room Rental</title>
    <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/png">
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

        .input-field {
            border: 1px solid #cbd5e1;
            /* border-gray-300 */
            padding: 0.75rem;
            /* p-3 */
            border-radius: 0.375rem;
            /* rounded-md */
            width: 100%;
        }

        .input-field:focus {
            border-color: #f72585;
            /* focus:border-pink-500 */
            box-shadow: 0 0 0 3px rgba(247, 37, 133, 0.3);
            /* focus:ring-pink-500 with opacity */
            outline: none;
        }

        .booking-hero-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/images/background.jpeg');
            /* Ganti dengan path gambar lokal Anda */
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

<body class="bg-body"> <!-- Changed from bg-gray-100 to use custom style -->
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

    <!-- Booking Hero Section -->
    <section class="booking-hero-bg text-white py-20">
        <div class="container mx-auto text-center">
            <h1 class="text-5xl font-bold mb-4">Pesan Ruangan Gaming Impian Anda</h1>
            <p class="text-xl mb-8">Amankan slot Anda sekarang dan bersiaplah untuk pengalaman tak terlupakan!</p>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="container mx-auto py-16 px-4">
        <div class="max-w-2xl mx-auto card-bg p-8 md:p-12 rounded-xl shadow-2xl">
            <h2 class="text-3xl font-bold mb-8 text-center text-black-accent">Formulir Pemesanan</h2>
            @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
            @endif
            <form action="{{ route('sewa.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Tipe Ruangan --}}
                <div>
                    <label for="room_type" class="block text-sm font-medium text-gray-700 mb-1">Pilih Tipe Ruangan</label>
                    <select id="room_type" name="room_type" class="input-field" required onchange="filterPSOptions()">
                        <option value="" disabled selected>-- Pilih Ruangan --</option>
                        <option value="Standar">Standard</option>
                        <option value="Silver">Silver</option>
                        <option value="Gold">Gold</option>
                        <option value="Platinum">Platinum</option>
                    </select>
                </div>

                {{-- Pilih PS --}}
                <div>
                    <label for="ps_id" class="block mb-1 text-sm font-medium text-gray-700">Pilih PS</label>
                    <select id="ps_id" name="ps_id" class="input-field" required>
                        <option value="" disabled selected>-- Pilih PS --</option>
                        @foreach($psList as $ps)
                        <option value="{{ $ps->ps_id }}" data-type="{{ ($ps->type) }}">
                            {{ $ps->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal dan Jam --}}
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="tanggal_pesan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pemesanan</label>
                        <input type="date" id="tanggal_pesan" name="tanggal_pesan" class="input-field" required>
                    </div>
                    <div>
                        <label for="booking_time" class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                        <input type="time" id="booking_time" name="booking_time" class="input-field"
                            required min="07:00" max="22:00" step="3600">
                    </div>
                </div>

                {{-- Durasi --}}
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Durasi (jam)</label>
                    <input type="number" id="duration" name="duration" class="input-field"
                        placeholder="Minimal 1 jam" min="1" value="1" required>
                </div>

                {{-- Tombol Submit --}}
                <div class="pt-4">
                    <button type="submit"
                        class="button-pink w-full px-8 py-4 rounded-full text-xl font-semibold transition-transform transform hover:scale-105">
                        Pesan Sekarang
                    </button>
                </div>
            </form>

        </div>
    </section>
    <!-- Why Book With Us Section -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-6 text-black-accent">Kenapa Memesan Dengan Kami?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-gamepad fa-3x mb-4 text-pink-accent"></i>
                    <h3 class="text-xl font-semibold text-black-accent mb-2">Koleksi Game Terbaru</h3>
                    <p class="text-gray-700 text-sm">Selalu update dengan game-game terkini dan terpopuler.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-couch fa-3x mb-4 text-pink-accent"></i>
                    <h3 class="text-xl font-semibold text-black-accent mb-2">Fasilitas Nyaman</h3>
                    <p class="text-gray-700 text-sm">Ruangan bersih, AC dingin, dan kursi ergonomis.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <i class="fas fa-tags fa-3x mb-4 text-pink-accent"></i>
                    <h3 class="text-xl font-semibold text-black-accent mb-2">Harga Kompetitif</h3>
                    <p class="text-gray-700 text-sm">Pengalaman gaming premium dengan harga terbaik.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2054 PS Zone. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 🔽 Filter PS berdasarkan room_type
            function filterPSOptions() {
                const roomType = document.getElementById('room_type').value;
                const psSelect = document.getElementById('ps_id');
                const options = psSelect.querySelectorAll('option');
                const menuButton1 = document.getElementById('menuButton1');
                const menuDropdown1 = document.getElementById('menuDropdown1');
                const menuButton = document.getElementById('menuButton');
                const menuDropdown = document.getElementById('menuDropdown');

                options.forEach(option => {
                    const psType = option.getAttribute('data-type');
                    if (!psType) {
                        option.hidden = false; // "-- Pilih PS --"
                        return;
                    }
                    option.hidden = psType !== roomType;
                });

                psSelect.value = '';
            }

            window.filterPSOptions = filterPSOptions; // agar bisa diakses dari onchange="filterPSOptions()"
        });

        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            menuDropdown.classList.toggle('hidden');
        });

        // Menutup dropdown desktop saat klik di luar
        document.addEventListener('click', function(event) {
            if (!menuButton.contains(event.target)) {
                menuDropdown.classList.add('hidden');
            }
        });

        menuButton1.addEventListener('click', function(e) {
            e.stopPropagation();
            menuDropdown1.classList.toggle('hidden');
        });

        // Menutup dropdown desktop saat klik di luar
        document.addEventListener('click', function(event) {
            if (!menuButton1.contains(event.target)) {
                menuDropdown1.classList.add('hidden');
            }
        });

        // 🔽 Hamburger Menu Mobile
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        if (hamburgerBtn && mobileMenu) {
            hamburgerBtn.addEventListener('click', () => {
                hamburgerBtn.classList.toggle('hamburger-active');
                mobileMenu.classList.toggle('hidden');
                mobileMenu.classList.toggle('show');
            });

            document.addEventListener('click', (event) => {
                if (!hamburgerBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                    hamburgerBtn.classList.remove('hamburger-active');
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('show');
                }
            });

            document.querySelectorAll('#mobileMenu a').forEach(link => {
                link.addEventListener('click', () => {
                    hamburgerBtn.classList.remove('hamburger-active');
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('show');
                });
            });
        }
    </script>

</body>

</html>