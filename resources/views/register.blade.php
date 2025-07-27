<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PS Room Rental</title>
    <link rel="icon" type="image/png" href="{{asset('image/logo.png') }}"> <!-- Tambahkan baris ini -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        }
        .button-pink:hover {
            background-color: #d01f6d;
        }
        .form-container {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .input-field {
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.75rem;
            width: 100%;
            transition: border-color 0.2s;
            margin-bottom: 20px;
        }
        .input-field:focus {
            border-color: #f72585;
            outline: none;
        }
    </style>
    <!-- Tambahkan CDN SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen">
    <!-- Navbar -->
    <nav class="navbar-bg p-4 sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('welcome.form') }}" class="text-white text-2xl font-bold flex items-center">
                <img src="{{ asset('image/logo.png') }}" alt="PS Rental Zone Logo" class="h-10 mr-2">
                PS Rental Zone
            </a>
        </div>
    </nav>

    <!-- Register Form -->
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-md mx-auto form-container p-8">
            <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">Daftar Akun Baru</h2>
            
            <form id="registerForm" method="POST">
    @csrf

    <!-- Nama -->
    <div>
        <label for="fullName" class="block text-gray-700 mb-2">Nama Lengkap</label>
        <input type="text" id="fullName" name="name" class="input-field" required>
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-gray-700 mb-2">Email</label>
        <input type="email" id="email" name="email" class="input-field" required>
    </div>

    <!-- Nomor Telepon -->
    <div>
        <label for="no_hp" class="block text-gray-700 mb-2">Nomor Telepon</label>
        <input type="tel" id="no_hp" name="no_hp" class="input-field" required>
    </div>

    <!-- Password -->
    <div>
        <label for="password" class="block text-gray-700 mb-2">Password</label>
        <input type="password" id="password" name="password" class="input-field" required>
    </div>

    <!-- Konfirmasi Password -->
    <div>
        <label for="confirmPassword" class="block text-gray-700 mb-2">Konfirmasi Password</label>
        <input type="password" id="confirmPassword" name="password_confirmation" class="input-field" required>
    </div>

    <!-- Tombol Submit -->
    <button type="submit" class="button-pink w-full py-3 rounded-lg font-semibold transition duration-200">
        Daftar
    </button>
</form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const showErrorAlert = (title, text) => {
        Swal.fire({
            icon: 'error',
            title: title,
            text: text,
            confirmButtonColor: '#f72585',
            iconColor: '#d01f6d'
        });
    };

    const showSuccessAlert = () => {
        Swal.fire({
            title: 'Registrasi Berhasil!',
            text: 'Silakan lanjut ke login.',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.location.href = '/login';
        });
    };

    // Ambil nilai input
    const name = document.getElementById('fullName').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('no_hp').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const csrfToken = document.querySelector('input[name="_token"]').value;

    // Validasi
    if (password !== confirmPassword) {
        return showErrorAlert('Oops...', 'Password dan konfirmasi tidak cocok!');
    }

    // Buat FormData
    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('no_hp', phone);
    formData.append('password', password);
    formData.append('password_confirmation', confirmPassword);
    formData.append('_token', csrfToken);

    // Kirim ke server
    fetch('/register', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) return response.json();
        throw new Error('Gagal mengirim data');
    })
    .then(data => {
        if (data.status === 'ok') {
            showSuccessAlert();
        } else {
            showErrorAlert('Gagal', data.message || 'Terjadi kesalahan saat registrasi');
        }
    })
    .catch(error => {
        console.error(error);
        showErrorAlert('Error', 'Terjadi kesalahan saat mengirim data');
    });
});
</script>
</body>
</html>