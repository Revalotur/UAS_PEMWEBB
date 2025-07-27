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
            0%, 100% {
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
            <a href="#" class="text-white text-2xl font-bold flex items-center">
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

                <!-- Tambahkan WhatsApp Link di sini -->
                <a href="https://wa.me/6289516079977?text=Halo kaka, sa mau pesan vip room ini bagaimana caranya?" target="_blank" class="text-white hover:text-green-400 transition-colors duration-300">
                    <i class="fab fa-whatsapp text-2xl"></i>
                </a>

                <!-- Profile Section -->
                <div id="profileSection" class="hidden relative">
                    <button id="profileDropdown" class="flex items-center space-x-2 text-white hover:text-pink-300">
                        <i class="fas fa-user-circle text-2xl"></i>
                        <span id="userNameDisplay" class="text-sm"></span>
                    </button>
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2">
                        <div class="px-4 py-2 border-b border-gray-200">
                            <p class="text-gray-600 text-sm">Login sebagai:</p>
                            <p id="userEmail" class="text-gray-800 font-semibold text-sm truncate"></p>
                        </div>
                        <a href="profile.html" class="block px-4 py-2 text-gray-800 hover:bg-pink-100">Profil Saya</a>
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-pink-100">Riwayat</a>
                        <hr class="my-2">
                        <a href="#" id="signOutButton" class="block px-4 py-2 text-red-600 hover:bg-red-50">Keluar</a>
                    </div>
                </div>

                <!-- Tombol Login -->
                <a href="{{ route('login.form')}}" id="loginButton" class="text-white hover:text-pink-300">
                    <i class="fas fa-sign-in-alt"></i>
                </a>
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

                <!-- Divider -->
                <div class="border-t border-gray-700 my-2"></div>

                <!-- Customer Service -->
                <div class="py-2">
                    <a href="https://wa.me/6289516079977?text=Halo kaka, sa mau pesan vip room ini bagaimana caranya?" target="_blank" 
                       class="flex items-center space-x-3 text-white hover:text-green-400 transition-colors duration-300">
                        <i class="fab fa-whatsapp text-2xl"></i>
                        <span>Contact Us!</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-700 my-2"></div>

                <!-- Profile Section untuk Mobile -->
                <div id="mobileProfileSection" class="hidden">
                    <div class="flex items-center space-x-2 text-white py-2">
                        <i class="fas fa-user-circle text-2xl"></i>
                        <span id="mobileUserEmailDisplay" class="text-sm"></span>
                    </div>
                    <div class="space-y-1">
                        <a href="#" class="block py-2 px-4 text-white hover:text-pink-300">Profil Saya</a>
                        <a href="#" class="block py-2 px-4 text-white hover:text-pink-300">Riwayat</a>
                        <a href="{{ route('login.form') }}" id="mobileSignOutButton" class="block py-2 px-4 text-red-400 hover:text-red-300">Keluar</a>
                    </div>
                </div>

                <!-- Tombol Login untuk Mobile -->
                <a href="{{ route('login.form') }}" id="mobileLoginButton" class="block py-2 px-4 text-white hover:text-pink-300">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            </div>
        </div>
    </div>
    </nav>


    <!-- Hero Section -->
    <div id="home" class="hero-bg text-white min-h-screen flex items-center justify-center">
        <div class="text-center bg-black bg-opacity-70 p-12 rounded-xl shadow-2xl fade-in-up">
            <h2 class="text-6xl font-bold mb-6 fade-in-up">Selamat Datang di PS Rental Zone!</h2>
            <p class="text-2xl mb-10 fade-in-up-delay">Destinasi utama untuk pengalaman gaming PlayStation terbaik dan
                tak terlupakan.</p>
            <a href="#about"
                class="button-pink px-10 py-4 rounded-full text-xl font-semibold transition-transform transform hover:scale-105 fade-in-up-delay">Jelajahi
                Sekarang</a>
        </div>
    </div>

    <!-- About Us Section -->
    <section id="about" class="container mx-auto py-20 px-4">
        <h2 class="section-title text-black-accent fade-in-up">Tentang PS Rental Zone</h2>
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="relative">
                <img src="{{ asset('image/interior.jpeg') }}" alt="Interior PS Rental Zone"
                    class="rounded-lg shadow-xl w-full">
            </div>
            <div class="text-lg text-gray-700 space-y-4">
                <p>Selamat datang di <strong class="text-pink-accent">PS Rental Zone</strong>, tempat di mana para gamer
                    berkumpul untuk menikmati koleksi game PlayStation terbaru dan terpopuler dalam suasana yang nyaman
                    dan modern.</p>
                <p>Kami berdedikasi untuk menyediakan pengalaman bermain game yang imersif dengan fasilitas terbaik,
                    mulai dari konsol PS5 terbaru, TV berkualitas tinggi, hingga kursi gaming ergonomis yang akan
                    membuat sesi bermainmu semakin menyenangkan.</p>
                <p>Lebih dari sekadar tempat rental, kami adalah komunitas. Kami percaya bahwa gaming adalah tentang
                    kesenangan, persahabatan, dan petualangan. Bergabunglah dengan kami dan rasakan bedanya!</p>
                <a href="#services"
                    class="inline-block mt-6 button-pink px-8 py-3 rounded-full text-lg font-semibold">Lihat Layanan
                    Kami</a>
            </div>
        </div>
    </section>

    <!-- Services/Features Section (Pemanis) -->
    <section id="services" class="bg-white py-20 px-4">
        <div class="container mx-auto">
            <h2 class="section-title text-black-accent">Kenapa Memilih Kami?</h2>
            <div class="grid md:grid-cols-3 gap-10 text-center">
                <div
                    class="p-6 card-bg rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-gamepad feature-icon"></i>
                    <h3 class="text-2xl font-bold mb-3 text-pink-accent">Koleksi Game Lengkap</h3>
                    <p class="text-gray-600">Dari rilisan terbaru hingga game klasik favorit, kami punya semuanya!</p>
                </div>
                <div
                    class="p-6 card-bg rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-couch feature-icon"></i>
                    <h3 class="text-2xl font-bold mb-3 text-pink-accent">Ruangan Nyaman & Stylish</h3>
                    <p class="text-gray-600">Desain ruangan modern dengan tema hitam dan pink yang memanjakan mata.</p>
                </div>
                <div
                    class="p-6 card-bg rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    <i class="fas fa-star feature-icon"></i>
                    <h3 class="text-2xl font-bold mb-3 text-pink-accent">Pengalaman VIP Eksklusif</h3>
                    <p class="text-gray-600">Nikmati fasilitas premium dan layanan terbaik di <a href="vip_room.html"
                            class="text-blue-600 hover:underline">VIP Room</a> kami.</p>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('booking.form') }}"
                    class="button-pink px-10 py-4 rounded-full text-xl font-semibold transition-transform transform hover:scale-105">Pesan
                    Ruangan Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Simplified Rooms Overview (Optional, jika masih ingin ada gambaran umum) -->
    <section id="room-overview" class="container mx-auto py-20 px-4">
        <h2 class="section-title text-black-accent">Pilihan Ruangan Kami</h2>
        <p class="text-center text-lg text-gray-700 mb-10">Kami menyediakan berbagai pilihan ruangan yang dapat
            disesuaikan dengan kebutuhan gaming Anda, mulai dari ruangan tematik hingga pengalaman VIP yang tak
            tertandingi.</p>
        <div class="flex justify-center space-x-6">
            <a href="{{ route('booking.form')}}" class="button-pink px-8 py-3 rounded-full text-lg font-semibold">Lihat Semua Ruangan
                Tematik</a>
            <a href="{{ route('vip.form')}}" class="button-outline-pink px-8 py-3 rounded-full text-lg font-semibold">Jelajahi
                VIP Room</a>
        </div>
    </section>


    <!-- Review Section -->
    <section id="reviews" class="bg-white py-20 px-4">
        <div class="container mx-auto">
            <h2 class="section-title text-black-accent">Ulasan Pelanggan</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Review Card 1 -->
                <div class="p-6 card-bg rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="{{asset('image/fab.jpg')}}" alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">Den Bagus Fabio</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Tempat yang keren banget! Fasilitas lengkap, ruangan nyaman, dan pelayanannya ramah. Recommended buat yang mau main PS bareng temen-temen!"</p>
                </div>

                <!-- Review Card 2 -->
                <div class="p-6 card-bg rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="{{asset('image/zak.jpg')}}" alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">Jeki</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"VIP Room-nya super cozy! Perfect buat quality time sama keluarga. Game-gamenya update terus, jadi ga pernah bosan main di sini."</p>
                </div>

                <!-- Review Card 3 -->
                <div class="p-6 card-bg rounded-lg shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="{{asset('image/rip.jpg')}}" alt="User" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">Rahayu</h4>
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Mantap! Koleksi gamenya lengkap, PS5-nya banyak, dan harganya worth it banget. Pasti bakal balik lagi!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <div id="contact" class="bg-black text-white py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12">Hubungi Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <i class="fas fa-map-marker-alt text-5xl mb-4 text-pink-400"></i>
                    <h3 class="text-2xl font-bold mb-2">Alamat Kami</h3>
                    <p>Jalan raya tajem, Wedomartani,Kabupaten Sleman, Daerah Istimewa Yogyakarta</p>
                </div>
                <div>
                    <i class="fas fa-phone text-5xl mb-4 text-pink-400"></i>
                    <h3 class="text-2xl font-bold mb-2">Telepon</h3>
                    <p>085888666649</p>
                </div>
                <div>
                    <i class="fas fa-envelope text-5xl mb-4 text-pink-400"></i>
                    <h3 class="text-2xl font-bold mb-2">Email</h3>
                    <p>pszone@gmail.com</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Hapus section customer service lama -->

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-4 text-center">
            <div class="flex justify-center space-x-10 mb-4">
                <a href="https://facebook.com/Zaaky.Ramadhan" target="_blank" class="text-white hover:text-pink-400 transition-colors">
                    <i class="fab fa-facebook text-2xl"></i>
                </a>
                <a href="https://instagram.com/fabiozgh_" target="_blank" class="text-white hover:text-pink-400 transition-colors">
                    <i class="fab fa-instagram text-2xl"></i>
                </a>
                <a href="https://tiktok.com/@oyentenn" target="_blank" class="text-white hover:text-pink-400 transition-colors">
                    <i class="fab fa-tiktok text-2xl"></i>
                </a>
            </div>
            <p class="mb-2 text-lg">&copy; 2025 Ps Zone. All rights reserved.</p>
            <p class="text-sm">Your Ultimate Gaming Destination!</p>
        </div>
    </footer>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi elemen-elemen
        const profileSection = document.getElementById('profileSection');
        const loginButton = document.getElementById('loginButton');
        const mobileProfileSection = document.getElementById('mobileProfileSection');
        const mobileLoginButton = document.getElementById('mobileLoginButton');
        const mobileUserEmailDisplay = document.getElementById('mobileUserEmailDisplay');
        const mobileSignOutButton = document.getElementById('mobileSignOutButton');
        const menuButton = document.getElementById('menuButton');
        const menuDropdown = document.getElementById('menuDropdown');
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        // Cek status login
        const isLoggedIn = localStorage.getItem('isLoggedIn');
        const userEmail = localStorage.getItem('userEmail');

        if (isLoggedIn === 'true' && userEmail) {
            mobileProfileSection.classList.remove('hidden');
            mobileLoginButton.classList.add('hidden');
            mobileUserEmailDisplay.textContent = userEmail;

            // Event listener untuk tombol keluar mobile
            mobileSignOutButton.addEventListener('click', function(e) {
                e.preventDefault();
                localStorage.removeItem('isLoggedIn');
                localStorage.removeItem('userEmail');
                window.location.href = 'login.html';
            });
        } else {
            mobileProfileSection.classList.add('hidden');
            mobileLoginButton.classList.remove('hidden');
        }

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
            if (!menuButton.contains(event.target)) {
                menuDropdown.classList.add('hidden');
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
    });
</script>
