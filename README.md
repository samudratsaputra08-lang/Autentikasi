Bagian 2: Langkah-Langkah Praktikum
Mari kita instal dan konfigurasikan Breeze ke dalam proyek "LaraPress".
1. Buka Terminal: Masuk ke direktori proyek LaraPress Anda.
2. Instalasi Breeze via Composer: Perintah ini akan mengunduh paket Breeze dan
dependensinya.
composer require laravel/breeze --dev
3. Jalankan Perintah Instalasi Breeze: Perintah ini akan mempublikasikan semua file
yang dibutuhkan (Controllers, Views, Routes) ke dalam aplikasi Anda.
php artisan breeze:install
○ Anda akan diberi beberapa pilihan. Pilih 0 untuk Blade with Alpine. Tekan Enter.
○ Pilih no untuk Dark mode support. Tekan Enter.
○ Pilih testing framework pilihan Anda (pilih 0 untuk Pest jika ragu). Tekan Enter.
4. Instalasi Dependensi Frontend: Breeze menggunakan Tailwind CSS. Perintah ini akan
menginstal dependensi JavaScript dari file package.json.
npm install
5. Kompilasi Aset: Perintah ini akan meng-compile file CSS dan JS agar bisa digunakan
oleh browser.
npm run dev
6. Jalankan Migrasi: Breeze perlu menambahkan kolom remember_token ke tabel users
dan membuat tabel password_reset_tokens.
php artisan migrate
7. Uji Coba: Jalankan server Anda (php artisan serve). Buka aplikasi di browser. Anda
sekarang akan melihat link "Log in" dan "Register" di pojok kanan atas. Coba buat
akun baru dan login!
Bagian 3: Membedah Hasil Instalasi (15 Menit)
Ajak mahasiswa untuk tidak hanya menggunakan, tetapi juga memahami apa yang baru saja
ditambahkan.
1. Lihat Rute Baru: Buka routes/web.php. Perhatikan ada baris baru require
__DIR__.'/auth.php';. Buka file routes/auth.php untuk melihat semua rute yang
didedikasikan untuk autentikasi.

2. Lihat Controller Baru: Buka direktori app/Http/Controllers/Auth/. Di sini Anda akan
menemukan file-file seperti AuthenticatedSessionController.php yang mengatur logika
login. Ajak mahasiswa untuk membacanya.
3. Lihat View Baru: Buka direktori resources/views/auth/. Di sinilah semua tampilan form
(login, register, dll) berada.
Bagian 4: Mengamankan Rute CRUD
Sekarang kita akan menggunakan sistem autentikasi ini untuk melindungi fitur-fitur yang sudah
kita buat.
1. Buka file routes/web.php.
2. Cari semua rute yang berhubungan dengan manajemen postingan (membuat,
menyimpan, mengedit, memperbarui, menghapus).
8. Bungkus semua rute tersebut di dalam sebuah route group dengan middleware('auth').
Contoh (Sebelum):
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);
// ... rute lainnya

9. Contoh (Sesudah):
1

Route::middleware('auth')->group(function () {
Route::get('/posts/create', [PostController::class,
'create'])->name('posts.create');
Route::post('/posts', [PostController::class,
'store'])->name('posts.store');
Route::get('/posts/{post}/edit', [PostController::class,
'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class,
'update'])->name('posts.update');
Route::delete('/posts/{post}', [PostController::class,
'destroy'])->name('posts.destroy');
});
3. Uji Coba:
○ Logout dari aplikasi Anda.
○ Sekarang, coba akses URL untuk membuat postingan baru:
http://127.0.0.1:8000/posts/create.
○ Apa yang terjadi? Laravel akan secara otomatis mengarahkan Anda ke halaman
login!

Kesimpulan
Pada pertemuan ini, kita telah berhasil menambahkan sistem autentikasi yang lengkap dan
aman ke dalam aplikasi "LaraPress". Kita tidak hanya belajar cara menginstal Laravel Breeze,
tetapi juga memahami konsep fundamental di baliknya. Kini aplikasi kita siap untuk fitur
selanjutnya: Otorisasi, di mana kita akan mengatur hak akses spesifik untuk setiap pengguna.
