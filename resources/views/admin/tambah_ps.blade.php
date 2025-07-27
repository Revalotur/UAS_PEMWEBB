<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah PS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-xl bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Tambah Data Playstation</h1>

        <form action="{{ route('ps.add_ps') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Nama</label>
                <input type="text" id="name" name="name" required class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label for="room_type" class="block text-sm font-semibold text-gray-700 mb-1">Pilih Tipe Ruangan</label>
                    <select id="type" name="type" class="input-field w-full border border-gray-300 rounded px-4 py-2 mt-1">
                        <option value="" disabled selected>-- Pilih Ruangan --</option>
                        <option value="standar">Standard</option>
                        <option value="Silver">Silver</option>
                        <option value="Gold">Gold</option>
                        <option value="Platinum">Platinum</option>
                    </select>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-semibold">Status</label>
                <input type="text" id="status" name="status" required class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label for="harga_per_jam" class="block text-gray-700 font-semibold">Harga/Jam</label>
                <input type="text" id="harga_per_jam" name="harga_per_jam" required class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-gray-800">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
