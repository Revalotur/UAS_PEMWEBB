<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rental Playstation</title>

    <link rel="icon" type="image/png" href="{{asset('image/logo.png') }}">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>
        body {
            background-color: #fde2f3;
        }

        .navbar-bg {
            background-color: #1a1a1a;
        }

        .button-pink {
            background-color: #f72585;
            color: white;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .button-pink:hover {
            background-color: #d01f6d;
            transform: scale(1.08) rotate(-2deg);
            box-shadow: 0 8px 24px 0 rgba(247, 37, 133, 0.2);
        }

        .button-outline-pink {
            border: 2px solid #f72585;
            color: #f72585;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .button-outline-pink:hover {
            background-color: #f72585;
            color: white;
            transform: scale(1.08) rotate(-2deg);
            box-shadow: 0 8px 24px 0 rgba(247, 37, 133, 0.2);
        }

        .card-bg {
            background-color: #ffffff;
            /* White Card Background */
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-bg:hover {
            transform: translateY(-10px) scale(1.04);
            box-shadow: 0 12px 32px 0 rgba(30, 30, 30, 0.15);
        }

        .text-pink-accent {
            color: #f72585;
            /* Hot Pink for Accents */
        }

        .text-black-accent {
            color: #1a1a1a;
            /* Black for Accents */
        }

        .hero-bg {
            background-image: url('https://source.unsplash.com/1600x900/?gaming,lounge,neon-lights');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            /* Parallax-like effect */
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

        .feature-icon {
            font-size: 3rem;
            /* 48px */
            margin-bottom: 1rem;
            /* 16px */
            color: #f72585;
            /* text-pink-accent */
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(40px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
        }

        .fade-in-up-delay {
            opacity: 0;
            animation: fadeInUp 1s 0.5s ease-out forwards;
        }

        /* Ganti style hamburger yang ada dengan yang baru */
        .hamburger-icon {
            transition: all 0.5s ease-in-out;
            transform-origin: center;
            animation: menuBounce 2s infinite;
        }

        .hamburger-active .hamburger-icon {
            animation: gamepadWiggle 1s ease-in-out infinite;
            color: #f72585;
        }

        @keyframes menuBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
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

        #mobileMenu {
            transform: translateY(-20px);
            transition: all 0.3s ease-in-out;
            opacity: 0;
            visibility: hidden;
        }

        #mobileMenu.show {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
    </style>
</head>

<body class="bg-pink-100">
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
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-pink-100">Profil</a>
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


    <div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow-lg mt-28 m-[45px]">

        <h2 class="text-2xl font-bold mb-6 text-center">Profil Saya</h2>

        {{-- Foto Profil --}}
        <div class="flex flex-col items-center mb-6">
            <img src="{{ $user->foto ? asset('storage/foto/' . $user->foto) : asset('image/default-user.png') }}"
                alt="Foto Profil" class="w-32 h-32 rounded-full object-cover border-4 border-pink-400">
            <div class="flex gap-2">
                <form action="{{ route('profile.update.foto') }}" method="POST" enctype="multipart/form-data" class="inline-block mt-2">
                    @csrf
                    <label class="cursor-pointer bg-pink-500 text-white px-3 py-2 rounded hover:bg-pink-600 flex items-center space-x-2">
                        <i class="fas fa-pencil-alt"></i> <!-- Icon Pensil -->
                        <input type="file" name="foto" class="hidden" onchange="this.form.submit()">
                    </label>
                </form>

                <!-- Form Hapus Foto -->
                <form action="{{ route('profile.delete.foto') }}" method="POST" class="inline-block mt-2">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 flex items-center space-x-2">
                        <i class="fas fa-trash-alt"></i> <!-- Icon Tong Sampah -->
                    </button>
                </form>
            </div>
        </div>

        {{-- Informasi Profil --}}
        <div class="space-y-4">

            <div class="flex justify-between items-center border-b pb-2">
                <div>
                    <p class="text-gray-600 text-sm">Nama</p>
                    <p class="text-lg font-semibold" id="displayName">{{ $user->name }}</p>
                </div>
                <button onclick="openEditModal()" class="text-pink-500 hover:text-pink-700">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>

            <div class="border-b pb-2">
                <p class="text-gray-600 text-sm">Email</p>
                <p class="text-lg font-semibold">{{ $user->email }}</p>
            </div>

            <div class="border-b pb-2">
                <p class="text-gray-600 text-sm">Nomor HP</p>
                <p class="text-lg font-semibold">{{ $user->no_hp }}</p>
            </div>

        </div>

    </div>

    {{-- Modal Edit Nama --}}
    <div id="editNameModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-80 relative">
            <button onclick="closeEditModal()" class="absolute top-2 right-3 text-gray-500 hover:text-red-500 text-xl">&times;</button>

            <h2 class="text-lg font-semibold mb-4 text-center">Edit Nama</h2>

            <form action="{{ route('profile.update.nama') }}" method="POST">
                @csrf
                <input type="text" name="name" value="{{ $user->name }}" class="w-full border rounded px-3 py-2 mb-4" required>

                <div class="flex justify-end">
                    <button type="button" onclick="closeEditModal()" class="mr-2 px-4 py-2 border rounded">Batal</button>
                    <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi elemen-elemen
        const menuButton = document.getElementById('menuButton');
        const menuDropdown = document.getElementById('menuDropdown');
        const menuButton1 = document.getElementById('menuButton1');
        const menuDropdown1 = document.getElementById('menuDropdown1');
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const editNameModal = document.getElementById('editNameModal'); // Mengganti nama variabel agar lebih jelas

        // Hamburger menu toggle
        hamburgerBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // Mencegah event bubbling
            hamburgerBtn.classList.toggle('hamburger-active');
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('show');
        });

        // Menutup menu saat klik di luar
        document.addEventListener('click', (event) => {
            if (!hamburgerBtn.contains(event.target) && !mobileMenu.contains(event.target)) {
                hamburgerBtn.classList.remove('hamburger-active');
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('show');
            }
        });

        // Menu dropdown desktop
        menuButton.addEventListener('click', function(e) {
            e.stopPropagation();
            menuDropdown.classList.toggle('hidden');
        });

        // Menutup dropdown desktop saat klik di luar
        document.addEventListener('click', function(event) {
            if (!menuButton.contains(event.target) && !menuDropdown.contains(event.target)) {
                menuDropdown.classList.add('hidden');
            }
        });

        // Menu dropdown user
        menuButton1.addEventListener('click', function(e) {
            e.stopPropagation();
            menuDropdown1.classList.toggle('hidden');
        });

        // Menutup dropdown user saat klik di luar
        document.addEventListener('click', function(event) {
            if (!menuButton1.contains(event.target) && !menuDropdown1.contains(event.target)) {
                menuDropdown1.classList.add('hidden');
            }
        });

        // Menutup menu mobile saat mengklik link
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => {
                hamburgerBtn.classList.remove('hamburger-active');
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('show');
            });
        });

        // --- Perbaikan Modal ---
        // Membuat fungsi menjadi global agar bisa diakses oleh onclick di HTML
        window.openEditModal = function() {
            editNameModal.classList.remove('hidden');
        }

        window.closeEditModal = function() {
            editNameModal.classList.add('hidden');
        }
    });
</script>