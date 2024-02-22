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
Route::resource('transactions', TransactionController::class)->middleware('auth');

Route::get('transaction/{kode}', [App\Http\Controllers\Api\TransaksiController::class,'formDonasi']);
Route::post('send-donasi', [App\Http\Controllers\Api\TransaksiController::class,'sendDonasi']);

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

// Faker
Route::get('faker-donatur', function () {
    $faker = \Faker\Factory::create('id_ID');
    // $donatur = App\Models\Donaturs::factory()->count(10)->create();
    // dump($donatur);
    for ($i = 1; $i <= 10; $i++) {
        $kode = sprintf("%04d", $i);
        Donaturs::create([
            'kode'=> 'A'.$kode,
            'nama' => $faker->firstNameMale().' '.$faker->lastNameMale(),
            'nama_outlet' => $faker->company(),
            'alamat' => $faker->address(),
            'no_hp' => $faker->phoneNumber(),
            'jenkel' => 'L',
            'status' => '1',
            'map' => '-',
        ]);

    }
    return "Data Donatur berhasil ditambah";
});
Route::get('faker-formrequest', function () {

    for ($i = 1; $i <= 10; $i++) {
        $str = new Illuminate\Support\Str;
        // $id = $faker->unique()->randomDigit();
        $kode = sprintf("%04d", $i);
        // echo $i . ') ' . $kode . " > ";
        // echo $str->random(10) . "<br>";
        App\Models\FormRequest::create(
            [
                'kode_donatur' => "A" . $kode,
                'uniq' => $str->random(10),
                'is_aktif' => true,
            ]
        );
    }
    return "Data Form berhasil ditambah";
    // dump($faker);
});


// relation user hasMany
Route::get('user-hasmany',function(){
    $data = User::find(2);
    echo "Data User" .$data->name."<br>";
    foreach ($data->transactions as $k) {
        echo " Kode = ".$k->keterangan. "<br>";
    }
});
Route::get('donatur-hasmany',function(){
    $data = Donaturs::find(2);
    echo "Data donatur" .$data->nama."<br>";
    foreach ($data->transactions as $k) {
        echo " Kode = ".$k->keterangan. "<br>";
    }
});

// relation trancaction belongto
Route::get('belongto',function(){
    $data = App\Models\Transaction::find(1);
    dd($data);
    // echo "Data Transaction" .$data->user->name."<br>";
    // foreach ($data->user as $k) {
    //     echo " Kode = ".$k->name. "<br>";
    // }
});

/* Export dan Import */
Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});

/* Lainnya */
Route::get('/donatur-rekap',[TransactionController::class,'donaturRekap'])->name('donatur.rekap');
Route::get('/transactions-export',[TransactionController::class,'transactionsExport'])->name('transactions.export')->middleware('can:create,'.User::class);

/* Cek transaksi */
Route::get('transaksi-user/{user_id}',[TransactionController::class,'transaksiUser'])->name('transaksi-user');
Route::get('transaksi-donatur/{donatur_id}',[TransactionController::class,'transaksiDonatur'])->name('transaksi-donatur');

/* Show user */
// Route
Route::get('user/{user}',[ App\Http\Controllers\Api\UserController::class , 'show'])->name('user.show')->middleware('can:view,user');
Route::put('user/{user}',[ App\Http\Controllers\Api\UserController::class , 'update'])->name('user.update')->middleware('can:update,user');
Route::delete('user/{user}',[ App\Http\Controllers\Api\UserController::class , 'destroy'])->name('user.destroy')->middleware('can:delete,user');
