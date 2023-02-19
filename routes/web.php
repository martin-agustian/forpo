<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// -- AUTH
Route::group(['as' => 'auth.'], function () {
    $ctrl = 'AuthController@';

    // ** GET
    Route::get('/', $ctrl.'login');
    Route::get('/login', $ctrl.'login')->name('login');
    Route::get('/logout', $ctrl.'logout')->name('logout');    

    // ** POST
    Route::post('/login', $ctrl.'login_post')->name('login');    
    Route::post('/', $ctrl.'login_post');
});


// -- DASHBOARD
Route::group(['as' => 'dashboard.'], function () {
    $ctrl = 'DashboardController@';

    // ** GET
    Route::get('/dashboard', $ctrl.'index')->name('index');
});


// -- MATA PELAJARAN
Route::group(['as' => 'mapel.'], function () {
    $ctrl = 'MapelController@';

    // ** GET
    Route::get('/mapel', $ctrl.'index')->name('index');
    Route::get('/mapel/get_pertemuan', $ctrl.'get_pertemuan')->name('get-pertemuan');    
    Route::get('/mapel/get_mapel', $ctrl.'get_mapel')->name('get-mapel');
    Route::get('/mapel/tugas', $ctrl.'tugas')->name('tugas');
    Route::get('/mapel/forum', $ctrl.'forum')->name('forum');
    Route::get('/mapel/forum_get_komentar', $ctrl.'forum_get_komentar')->name('forum-get-komentar');

    // ** POST
    Route::post('/mapel/tugas/upload', $ctrl.'tugas_upload')->name('tugas-upload');
    Route::post('/mapel/forum/send_comment', $ctrl.'forum_kirim_komentar')->name('forum-kirim-komentar');
});


// -- NILAI
Route::group(['as' => 'nilai.'], function () {
    $ctrl = 'NilaiController@';

    // ** GET
    Route::get('/nilai', $ctrl.'index')->name('index');
    Route::get('/nilai/get_nilai', $ctrl.'get_nilai')->name('get-nilai');
});


// -- JADWAL
Route::group(['as' => 'jadwal.'], function () {
    $ctrl = 'JadwalController@';

    // ** GET
    Route::get('/jadwal', $ctrl.'index')->name('index');
    Route::get('/jadwal/get_jadwal', $ctrl.'get_jadwal')->name('get-jadwal');
});


// -- DASHBOARD
Route::group(['as' => 'dashboard.'], function () {
    $ctrl = 'DashboardController@';

    // ** GET
    Route::get('/dashboard', $ctrl.'index')->name('index'); // BASE URL
});

