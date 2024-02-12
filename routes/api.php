<?php


use App\Http\Controllers\Api\DonaturController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\UserController;
// use App\Models\Donaturs;
// use Doctrine\DBAL\Schema\Index;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

#Donatur
Route::get('donatur', [DonaturController::class, 'index']);
Route::get('donatur/{id}', [DonaturController::class, 'show']);
Route::post('donatur', [DonaturController::class, 'store']);
Route::put('donatur/{id}', [DonaturController::class, 'update']);
Route::delete('donatur/{id}', [DonaturController::class, 'destroy']);

#Login
Route::post('login', [UserController::class, 'login']);
Route::get('all-user', [UserController::class, 'all']);

#Transaksi
// kode donatur
Route::get('transaksi/{kode}',[DonaturController::class,'kode']);
Route::post('transaksi',[TransaksiController::class,'index']);
