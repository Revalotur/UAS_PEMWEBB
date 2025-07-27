<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-xl bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">Edit Data User</h1>

        <form action="{{ route('ps.update', $ps->ps_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Nama</label>
                <input type="text" id="name" name="name" value="{{ $ps->name }}" required class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold">Status</label>
                <input type="text" id="status" name="status" value="{{ $ps->status }}" required class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="mb-4">
                <label for="no_hp" class="block text-gray-700 font-semibold">Harga/Jam</label>
                <input type="text" id="harga_per_jam" name="harga_per_jam" value="{{ $ps->harga_per_jam }}" required class="w-full border border-gray-300 rounded px-4 py-2 mt-1">
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-gray-800">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
