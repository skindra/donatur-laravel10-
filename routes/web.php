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

// Route::post('logout',[App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::get('generate-admin', function () {
    $data = User::where('email', 'admin@gmail.com')->first();
    if (!$data) {

        User::create(
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
            ]
        );

        return "Berhasil di proses";
    }
    return "Data sudah ada di proses";
});
Route::get('generate-staff', function () {
    $data = User::where('email', 'staff@gmail.com')->first();
    if (!$data) {

        User::create(
            [
                'name' => 'staff',
                'email' => 'staff@gmail.com',
                'password' => Hash::make('12345678'),
            ]
        );

        return "Berhasil di proses";
    }
    return "Data sudah ada di proses";
});

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
    $data = App\Models\Transaction::find(2);
    echo "Data Transaction" .$data->nominal.$data->user->name."<br>";
    // foreach ($data->user as $k) {
    //     echo " Kode = ".$k->name. "<br>";
    // }
});
