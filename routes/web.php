<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalRegisterController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\PermintaaanBarangController;
use App\Http\Controllers\RegisterController;
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


Route::get('/', function () {
    $data['page_title'] = "Login";
    return view('auth.login', $data);
})->name('user.login');

Route::get('/login-management', function () {
    $data['page_title'] = "Login Management";
    return view('auth.login', $data);
})->name('login-management');

Route::get('/login-siswa', function () {
    $data['page_title'] = "Login Siswa";
    return view('auth.login-siswa', $data);
})->name('login-siswa');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('loginPost2', [UserController::class, 'loginPost2'])->name('loginPost2');
Route::post('login-siswa-post', [UserController::class, 'loginSiswa'])->name('login-siswa-post');


Route::middleware('auth:web')->group(function () {
    
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');

    Route::get('approval-list', [ApprovalRegisterController::class, 'notifikasi'])->name('approval-list');
    
    Route::post('approve-register/{id}', [ApprovalRegisterController::class, 'approval'])->name('approve-register');
    Route::post('not-approve-register/{id}', [ApprovalRegisterController::class, 'notApprove'])->name('not-approve-register');
    
    Route::get('siswa', [DataSiswaController::class, 'index'])->name('siswa');
    Route::get('tambah-siswa', [DataSiswaController::class, 'create'])->name('tambah-siswa');
    Route::post('store-siswa', [DataSiswaController::class, 'store'])->name('store-siswa');
    Route::get('edit-siswa/{id}', [DataSiswaController::class, 'edit'])->name('edit-siswa');
    Route::post('update-siswa/{id}', [DataSiswaController::class, 'update'])->name('update-siswa');
    Route::get('destroy-siswa/{id}', [DataSiswaController::class, 'destroy'])->name('destroy-siswa');
    Route::get('change-password-siswa/{id}', [DataSiswaController::class, 'changePassword'])->name('change-password-siswa');
 
    Route::get('data-absen-siswa', [AbsensiController::class, 'index'])->name('data-absen-siswa');
    Route::get('absen', [AbsensiController::class, 'store'])->name('absen');

     Route::get('master-data', function () {
        $data['page_title'] = 'Master Data';
        $data['breadcumb'] = 'Master Data';
        return view('master-data.index', $data);
    })->name('master-data.index');

    Route::resource('departements', DepartementController::class);

    Route::patch('change-password', [UserController::class, 'changePassword'])->name('users.change-password');

    Route::resource('users', UserController::class)->except([
        'show'
    ]);;

    Route::get('user-destroy/{id}', [UserController::class, 'destroy'])->name('user-destroy');

   
    Route::resource('profile', ProfileController::class)->except([
        'show','create', 'store'
    ]);

    Route::patch('change-password-profile', [ProfileController::class, 'changePassword'])->name('profile.change-password');


});

