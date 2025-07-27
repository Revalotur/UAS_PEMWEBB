<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex flex-col md:flex-row">

    <!-- Mobile Nav -->
    <header class="bg-white shadow-md md:hidden flex items-center justify-between px-4 py-3">
        <div class="text-xl font-bold text-blue-600">Admin Panel</div>
        <button id="toggleSidebar" class="focus:outline-none">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-full md:w-64 bg-white shadow-md hidden md:block">  
        <div class="p-6 text-2xl font-bold text-blue-600 border-b hidden md:block">
            Admin Panel
        </div>
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="#" onclick="showSection('dashboardSection')" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-800 font-medium">Dashboard</a>
                </li>
                <li>
                    <a href="#" onclick="showSection('userSection')" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-800 font-medium">Data User</a>
                </li>
                <li>
                    <a href="#" onclick="showSection('psSection')" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-800 font-medium">Data Playstation</a>
                </li>
                <li>
                    <a href="#" onclick="showSection('sewaSection')" class="block px-4 py-2 rounded hover:bg-blue-100 text-gray-800 font-medium">Data Sewa</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 rounded hover:bg-red-100 text-red-600 font-medium">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-4 md:p-8">
        <!-- Dashboard Section -->
        <section id="dashboardSection">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Dashboard</h1>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-gray-700 mb-4">Statistics</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-blue-100 rounded-lg p-4 text-center shadow">
                        <h3 class="text-lg font-semibold text-gray-800">User</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $jumlah_user }}</p>
                    </div>
                    <div class="bg-green-100 rounded-lg p-4 text-center shadow">
                        <h3 class="text-lg font-semibold text-gray-800">Playstation</h3>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $jumlah_ps }}</p>
                    </div>
                    <div class="bg-yellow-100 rounded-lg p-4 text-center shadow">
                        <h3 class="text-lg font-semibold text-gray-800">Revenue</h3>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $total_pemasukan }}</p>
                    </div>
                    <div class="bg-purple-100 rounded-lg p-4 text-center shadow">
                        <h3 class="text-lg font-semibold text-gray-800">Games</h3>
                        <p class="text-3xl font-bold text-purple-600 mt-2">{{ $jumlah_games }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Data User Section -->
        <section id="userSection" class="hidden">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Data User</h1>
            <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
                <table class="w-full table-auto text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">No HP</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $user->user_id }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->no_hp }}</td>
                            <td class="px-4 py-2">{{ $user->role }}</td>
                            <td>
                                <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin hapus?')" class="border px-3 py-1 rounded-md bg-red-600 text-white">Hapus</button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Data Playstation Section -->
        <section id="psSection" class="hidden">
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Data Playstation</h1>
            <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-end mb-4">
        <a href="{{ route('ps.create') }}" class="bg-blue-500 px-3 py-2 rounded-md text-white font-medium hover:bg-blue-400">Tambah</a>
    </div>

    <table class="w-full table-auto text-left">
        <thead>
            <tr>
                <th class="px-4 py-2">ID</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Type Ruangan</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Harga/Jam</th>
            </tr>
        </thead>
       <tbody>
        @foreach ($ps as $item)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $item->ps_id }}</td>
                <td class="px-4 py-2">{{ $item->name }}</td>
                <td class="px-4 py-2">{{ $item->type }}</td>
                <td class="px-4 py-2">{{ $item->status }}</td>
                <td class="px-4 py-2">Rp{{ number_format($item->harga_per_jam, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>

    </table>
</div>

        </section>

        <!-- Data Sewa Section -->
        <section id="sewaSection" class="hidden">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Data Sewa</h1>

    <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
        <table class="w-full table-auto text-left">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">PS ID</th>
                    <th class="px-4 py-2">Nama Penyewa</th>
                    <th class="px-4 py-2">Tanggal Booking</th>
                    <th class="px-4 py-2">Waktu Mulai</th>
                    <th class="px-4 py-2">Durasi</th>
                    <th class="px-4 py-2">Total Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sewa as $item)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $item->sewa_id }}</td>
                <td class="px-4 py-2">{{ $item->ps_id }}</td>
                <td class="px-4 py-2">{{ $item->user->name  }}</td>
                <td class="px-4 py-2">{{ $item->tanggal_pesan }}</td>
                <td class="px-4 py-2">{{ $item->waktu_mulai ?? '-' }}</td>
                <td class="px-4 py-2">{{ $item->durasi }} jam</td>
                <td class="px-4 py-2">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
        @endforeach
            </tbody>
        </table>
    </div>
</section>


    </main>

    <script>
        const sections = ['dashboardSection', 'userSection', 'psSection', 'sewaSection'];

        function showSection(sectionId) {
            sections.forEach(id => {
                document.getElementById(id).classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        }

        // Toggle sidebar for mobile
        document.getElementById('toggleSidebar')?.addEventListener('click', () => {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>
