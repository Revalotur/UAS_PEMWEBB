<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - PS RENTAL ZONE</title>
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">
    @vite(['resources/css/app.css'])
    <style>
        .gradient-background {
            background: linear-gradient(135deg, #1a1a1a 0%, #333333 100%);
        }
    </style>
</head>
<body class="gradient-background min-h-screen">

    <nav class="bg-black py-4 mb-24">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a href="{{ route('welcome.form')}}" class="text-white text-2xl font-bold flex">
                <img src="{{ asset('image/logo.png') }}" alt="PS Rental Zone Logo" class="h-10 mr-2" />
                PS RENTAL ZONE
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-16">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="px-6 py-8">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Login Rental Zone</h2>

                {{-- Tampilkan error jika login gagal --}}
                @if ($errors->any())
                    <div class="mb-4 text-red-500 text-sm text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="pt-2 pb-6">
                        <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                            placeholder="Masukkan email Anda" value="{{ old('email') }}">
                    </div>
                    <div class="pb-1">
                        <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                            placeholder="Masukkan password Anda">
                    </div>
                    <div class="flex items-center justify-between pb-8">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember"
                                class="h-4 w-4 text-pink-500 focus:ring-pink-500 border-gray-300 rounded">
                            <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                        </div>
                        <a href="#" class="text-sm text-pink-500 hover:text-pink-600">Lupa password?</a>
                    </div>
                    <button type="submit"
                        class="w-full bg-pink-500 text-white py-2 px-4 rounded-lg hover:bg-pink-600 transition duration-200">
                        Masuk
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-gray-600">Belum punya akun? 
                        <a href="{{ route('register.form') }}" class="text-pink-500 hover:text-pink-600">Daftar sekarang</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
