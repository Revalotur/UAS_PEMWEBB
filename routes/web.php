<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PsController;
use App\Http\Controllers\JadwalController;
use App\Http\Middleware\CekAdmin;
use App\Http\Middleware\CekLogin;
use App\Http\Controllers\SewaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome.form');

Route::get('/login', function () {
    return view('login');
})->name('login.form');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('ceklogin')->group(function () {

    Route::get('/welcomeuser', [UserController::class, 'index'])->name('welcomeuser');

    Route::get('/pesan', [SewaController::class, 'showBookingForm'])->name('booking.form');
    Route::post('/pesan', [SewaController::class, 'store'])->name('sewa.store');

    Route::get('/jadwal', [JadwalController::class, 'showJadwal'])->name('jadwal.form');

    Route::get('/vip', [UserController::class, 'index'])->name('vip.form');
    Route::get('/riwayat', [SewaController::class, 'riwayatuser'])->name('riwayat.user');

    Route::get('/konfirmasi', function () {
        return view('konfirmasi');
    })->name('konfirmasi.form');

    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile'); // Tampil profil
    Route::post('/profile/update', [ProfileController::class, 'updateNama'])->name('profile.update.nama'); // Update nama + foto
    Route::post('/profile/foto', [ProfileController::class, 'updateFoto'])->name('profile.update.foto'); // Update foto saja
    Route::post('/profile/foto/hapus', [ProfileController::class, 'hapusFoto'])->name('profile.delete.foto');
});

Route::get('/register', function (){
    return view('register');
})->name('register.form');


Route::resource('users', UserController::class);
Route::get('/users/{user_id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::delete('/users/{user_id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::resource('ps', PsController::class);
Route::get('/ps/{ps_id}/edit', [PsController::class, 'edit'])->name('ps.edit');
Route::put('/ps/{ps_id}', [PsController::class, 'update'])->name('ps.update');
Route::delete('/ps/{ps_id}', [PsController::class, 'destroy'])->name('ps.destroy');


Route::post('/register', [RegisterController::class, 'register'])->name('register');

# Route admin panel
Route::get('/login/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login/admin', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/logout/admin', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['cekadmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/ps/create', [PsController::class, 'create'])->name('ps.create');
    Route::post('/ps', [PsController::class, 'add_ps'])->name('ps.add_ps');
});




