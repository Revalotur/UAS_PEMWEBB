<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Ruangan Harian - PS Rental Zone</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}"> <!-- Tambahkan baris ini -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9c4f6;
            /* Slightly different light gray for variety */
        }

        .navbar-bg {
            background-color: #1a1a1a;
            /* Dark/Black Navbar */
        }

        .text-pink-accent {
            color: #f72585;
            /* Hot Pink for Accents */
        }

        .text-black-accent {
            color: #1a1a1a;
            /* Black for Accents */
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
            /* mb-6 */
            font-size: 0.8rem;
            /* Smaller font for table cells */
        }

        .schedule-table th,
        .schedule-table td {
            border: 1px solid #cbd5e1;
            /* Tailwind's gray-300 */
            padding: 0.5rem;
            /* p-2 */
            text-align: center;
            min-width: 50px;
            /* Minimum width for hour cells */
        }

        .schedule-table th {
            background-color: #e2e8f0;
            /* Tailwind's gray-200 */
            font-weight: 600;
            /* font-semibold */
        }

        .schedule-table td.room-name {
            background-color: #f1f5f9;
            /* Tailwind's gray-100 */
            font-weight: 600;
            /* font-semibold */
            text-align: left;
            min-width: 150px;
        }

        .slot-available {
            background-color: #f0fff4;
            /* Lighter green, e.g., Tailwind's green-50 */
            color: #2f855a;
            /* Tailwind's green-700 */
        }

        .slot-booked {
            background-color: #fff5f5;
            /* Lighter red/pink, e.g., Tailwind's red-50 */
            color: #c53030;
            /* Tailwind's red-700 */
            font-weight: 500;
        }

        .slot-booked strong {
            color: #1a1a1a;
            /* Black for booker's name */
        }

        .table-container {
            overflow-x: auto;
            /* Allows horizontal scrolling for the table on small screens */
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

<body>
    <div class="flex flex-col min-h-screen">
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

    <!-- Main Content Section -->
    <div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Riwayat Pemesanan Anda</h2>

        @if ($riwayat->isEmpty())
        <p class="text-center text-gray-500">Belum ada pesanan yang dibuat.</p>
        @else
        <table class="w-full table-auto text-left border-collapse">
            <thead>
                <tr class="bg-pink-200 text-pink-800">
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">PS</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Jam</th>
                    <th class="px-4 py-2 border">Durasi</th>
                    <th class="px-4 py-2 border">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $index => $item)
                <tr class="hover:bg-pink-50">
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $item->ps->name }} ({{ $item->ps->type }})</td>
                    <td class="px-4 py-2 border">{{ $item->tanggal_pesan }}</td>
                    <td class="px-4 py-2 border">{{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</td>
                    <td class="px-4 py-2 border">{{ $item->durasi }} jam</td>
                    <td class="px-4 py-2 border">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    </div>


    <!-- Footer -->
    <footer class="bg-black text-white py-7 mt-14">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 PS Zone. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scheduleTableBody = document.getElementById('scheduleTableBody');
            const dateSelector = document.getElementById('dateSelector');


            // Set tanggal hari ini sebagai default
            const today = new Date();
            dateSelector.value = today.toISOString().split('T')[0];

            const allRoomTypes = [{
                    value: 'standard_ps4',
                    label: 'Ruangan Standard PS4'
                },
                {
                    value: 'standard_ps5',
                    label: 'Ruangan Standard PS5'
                },
                {
                    value: 'vip_silver',
                    label: 'VIP Silver Access'
                },
                {
                    value: 'vip_gold',
                    label: 'VIP Gold Access'
                },
                {
                    value: 'vip_platinum',
                    label: 'VIP Platinum Suite'
                }
            ];

            function updateSchedule() {
                const selectedDate = dateSelector.value;
                const bookings = JSON.parse(localStorage.getItem('bookings')) || [];

                // Filter booking berdasarkan tanggal yang dipilih
                const filteredBookings = bookings.filter(booking => {
                    return booking.date === selectedDate;
                });

                if (scheduleTableBody) {
                    let tableHtml = '';
                    allRoomTypes.forEach(room => {
                        tableHtml += `<tr><td class="room-name">${room.label}</td>`;
                        for (let hour = 7; hour < 23; hour++) {
                            let cellContent = 'Kosong';
                            let cellClass = 'slot-available';
                            let bookingFound = null;

                            // Cek apakah ada booking yang mencakup jam ini untuk ruangan ini
                            for (const booking of filteredBookings) {
                                if (booking.roomType === room.value) {
                                    const bookingStartHour = parseInt(booking.time.split(':')[0]);
                                    const bookingDuration = parseInt(booking.duration);
                                    const bookingEndHour = bookingStartHour + bookingDuration;

                                    if (hour >= bookingStartHour && hour < bookingEndHour) {
                                        bookingFound = booking;
                                        break;
                                    }
                                }
                            }

                            if (bookingFound) {
                                cellClass = 'slot-booked';
                                cellContent = `<strong>${bookingFound.name}</strong>`;
                            }
                            tableHtml += `<td class="${cellClass}">${cellContent}</td>`;
                        }
                        tableHtml += `</tr>`;
                    });
                    scheduleTableBody.innerHTML = tableHtml;
                }
            }

            // Update jadwal saat tanggal berubah
            dateSelector.addEventListener('change', updateSchedule);

            // Tampilkan jadwal untuk hari ini saat halaman dimuat
            updateSchedule();
        });

        const menuButton1 = document.getElementById('menuButton1');
        const menuDropdown1 = document.getElementById('menuDropdown1');
        const menuButton = document.getElementById('menuButton');
        const menuDropdown = document.getElementById('menuDropdown');

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