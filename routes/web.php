<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/tentang-kami', function () { 
return view('about'); // Kita akan menampilkan view bernama 'about' 
});

Route::get('/kontak', function () { 
return view('kontak'); // Kita akan menampilkan view bernama 'about' 
});