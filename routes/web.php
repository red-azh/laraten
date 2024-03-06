<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahaSantriController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// middleware = pengaman
// jalur ini diizinkan untuk user yang sudah login
// dan unuutk user yang rolenya itu user dan admin
// role ini bukan dari database tapi dari kernel
Route::middleware('auth', 'role:user,admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // hal. table
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');

    // hal. form tambah data
    Route::get('/kategori/create', [KategoriController::class, 'create']);
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');

    // hal. show
    Route::get('/kategori/show/{id}', [KategoriController::class, 'show'])->name('kategori.show');

    // update
    Route::get('/kategori/update/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');

    // hapus
    Route::get('/kategori/hapus/{id}', [KategoriController::class, 'destroy'])->name('kategori.hapus');


    // hal. buku
    Route::get('/books', [BukuController::class, 'index'])->name('books');


    // hal. tambah buku
    Route::get('/buku/create', [BukuController::class, 'create'])->name('books.tambah');
    Route::post('/buku/store', [BukuController::class, 'store'])->name('books.store');


    // hal. show
    Route::get('/buku/show/{id}', [BukuController::class, 'show'])->name('books.show');

    // hal. edit
    Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('books.edit');
    Route::put('/buku/update/{id}', [BukuController::class, 'update'])->name('books.update');

    // hal. hapus
    Route::get('/books/hapus/{id}', [BukuController::class, 'destroy'])->name('books.hapus');
});
//  unutk jalur khsus role admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    route::resource('buku', BukuController::class);
});

// Route::get('/user', function () {
//     return 'Anda User Aplikasi';
// })->name('user')->middleware('auth');

// Route::get('/admin', function () {
//     return 'Selamat datang admin';
// })->name('admin')->middleware('auth');



// ====================================================================================================


Route::get('/home', function () {
    return view('master.dashboard');
});

// Route::get('/dashboard', function () {//     return view('dashboard');
// });
// kalo pake pake url pake ini                                 ini pake route(alias)
Route::get('/mahasantri_petik', [MahaSantriController::class, 'index'])->name('santri');
Route::get('/mahasantri/{id}', [MahaSantriController::class, 'getid']); # buat bikin id
Route::get('/mahasantri_cari', [MahaSantriController::class, 'cari']);

// format query string adalah (id?=1) dan query get pakai method GET








// =====---- Halaman Bukuuuuuuuu!!!! ----=====



// php artisan route:list


require __DIR__ . '/auth.php';
