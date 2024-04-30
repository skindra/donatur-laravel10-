<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DonatursController;
use App\Http\Controllers\TransactionController;
// use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\DaftarDonaturController;
use App\Http\Controllers\QrCodeController;
use App\Models\Donatur as Donaturs;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Lainya\UserController;
use App\Http\Requests\Transaction;
use RealRashid\SweetAlert\Facades\Alert;

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

// Route::get('/', [DonatursController::class,'index']);
Route::get('/', function () {
    return view('welcome');
});

Route::resource('donaturs', DonatursController::class)->middleware('auth');
Route::get('donatur-check', [DonatursController::class, 'checkDonatur'])->name('donatur.check')->middleware('auth');
Route::resource('transactions', TransactionController::class)->middleware('auth');

Route::get('transaction/{kode}', [App\Http\Controllers\Api\TransaksiController::class, 'formDonasi']);
Route::post('send-donasi', [App\Http\Controllers\Api\TransaksiController::class, 'sendDonasi']);

// Route::put('donaturs/{id}/edit',[DonatursController::class,'update'])->name('donaturs.edit');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('form-pendaftaran', [DaftarDonaturController::class, 'index'])->name('form-pendaftaran');
Route::post('form-pendaftaran', [DaftarDonaturController::class, 'daftar'])->name('form-pendaftaran');
Route::get('status', function () {
    if (empty(session('pesan'))) {
        return redirect('/');
    }
    return view('status-pendaftaran', []);
});

Route::redirect('/', '/form-pendaftaran');

Route::get('kode-donatur', [DonatursController::class, 'kodeDonatur'])->name('kode-donatur');
Route::get('nama-donatur', [DonatursController::class, 'namaDonatur'])->name('nama-donatur');

// qrcode
Route::get('/qrcode', [QrCodeController::class, 'show']);
Route::get('/qrcode-download', [QrCodeController::class, 'download']);
Route::get('test', fn () => phpinfo());


/* Export dan Import */
Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});

/* Lainnya */
Route::get('/donatur-rekap', [TransactionController::class, 'donaturRekap'])->name('donatur.rekap');
Route::post('/transactions-export', [TransactionController::class, 'transactionsExport'])->name('transactions.export')->middleware('can:create,' . User::class);
Route::get('/form-donatur-rekap', function () {
    return view('lainnya.form-donatur-rekap');
});

/* Cek transaksi */
Route::get('transaksi-user/{user_id}', [TransactionController::class, 'transaksiUser'])->name('transaksi-user');
Route::get('transaksi-donatur/{donatur_id}', [TransactionController::class, 'transaksiDonatur'])->name('transaksi-donatur');

/* Show user */
// Route
Route::get('user/{user}', [App\Http\Controllers\Api\UserController::class, 'show'])->name('user.show')->middleware('can:view,user');
Route::put('user/{user}', [App\Http\Controllers\Api\UserController::class, 'update'])->name('user.update')->middleware('can:update,user');
Route::delete('user/{user}', [App\Http\Controllers\Api\UserController::class, 'destroy'])->name('user.destroy')->middleware('can:delete,user');
