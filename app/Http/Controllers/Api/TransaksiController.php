<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'nominal' => "required|integer",
            'user_id' => "required|integer",
            'donatur_id' => "required|integer",
        ], [
            'donatur_id.required' => "Donatur Kosong",
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Data gagal input",
                'data' => $validateData->errors(),
            ], 404);
        }
        $transactions = new Transaction();
        $transactions->donatur_id = $request->donatur_id;
        $transactions->user_id = $request->user_id;
        $transactions->nominal = $request->nominal;
        $transactions->keterangan = $request->keterangan ?? '';
        $transactions->status = 'rekam';

        $dataTransactions = $transactions->save();
        if (!$dataTransactions) {
            return response()->json([
                'status' => false,
                'message' => "Data gagal di tambahkan",
            ]);
        }
        return response()->json([
            'status' => true,
            'message' => "Data berhasil di tambahkan",
            'data' => $transactions,
        ]);
    }

    public function formDonasi($id)
    {
        $user = User::all();
        $data = Donatur::where('kode', $id)->first();
        if (!$data) {
            return view('transaksi.alert', ['pesan' => "Maaf Data Tidak ditemukan"]);
        }
        return view('transaksi.android', ['donatur' => $data, 'user' => $user]);
    }

    public function sendDonasi(Request $request)
    {
        $validateData = $request->validate(
            [
                'keterangan' => 'required',
                'donatur_id' => '',
                'nominal' => 'required|numeric',
                'user_id' => '',
            ]
        );

        Transaction::create($validateData);
        return view('transaksi.alert', ['pesan' => "Selamat Data Berhasil di Simpan"]);
    }
}
