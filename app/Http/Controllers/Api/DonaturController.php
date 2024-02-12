<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Donatur as Donaturs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DonaturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Donaturs::orderBy('id', 'desc')->get();
        return response()->json(
            [
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataDonatur = new Donaturs;
        $rules = [
            'nama' => 'required',
            'nama_outlet' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'jenkel' => 'required:in:L,P',
            'kode' => 'required|alpha_num|min:5|unique:donaturs',
            'map' => '',
            'status' => '',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Data ada yang salah",
                'data' => $validator->errors(),
            ]);
        }
        $dataForm['kode'] = $request->kode;
        $dataForm['nama'] = $request->nama;
        $dataForm['nama_outlet'] = $request->nama_outlet;
        $dataForm['alamat'] = $request->alamat;
        $dataForm['no_hp'] = $request->no_hp;
        $dataForm['jenkel'] = $request->jenkel;
        $dataForm['jenkel'] = $request->jenkel;

        $post = $dataDonatur->create($dataForm);

        return response()->json([
            'status' => true,
            'message' => 'data berhasil ditambah',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Donaturs::find($id);
        if ($data) {
            # code...
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataDonatur = Donaturs::find($id);
        if (empty($dataDonatur)) {
            return response()->json([
                'status' => false,
                'message' => "Data tidak ditemukan",
                'data' => null,
            ], 404);
        }
        $rules = [
            'nama' => 'required',
            'nama_outlet' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric',
            'jenkel' => 'required:in:L,P',
            'kode' => '',
            'map' => '',
            'status' => '',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Data ada yang salah",
                'data' => $validator->errors(),
            ]);
        }
        $dataForm['kode'] = $request->kode;
        $dataForm['nama'] = $request->nama;
        $dataForm['nama_outlet'] = $request->nama_outlet;
        $dataForm['alamat'] = $request->alamat;
        $dataForm['no_hp'] = $request->no_hp;
        $dataForm['jenkel'] = $request->jenkel;
        $dataForm['jenkel'] = $request->jenkel;

        $post = $dataDonatur->update($dataForm);

        return response()->json([
            'status' => true,
            'message' => 'Sukses melakukan update data',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataDonatur = Donaturs::find($id);
        if (empty($dataDonatur)) {
            return response()->json([
                'status' => false,
                'message' => "Data tidak ditemukan",
                'data' => null,
            ], 404);
        }
        $dataDonatur->delete();
        return response()->json([
            'status' => false,
            'message' => "Data sukses dihapus",
        ], 200);
    }


    public function kode(string $kode)
    {
        $data = Donaturs::where('kode', $kode)->first();
        if ($data) {
            # code...
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => null,
            ]);
        }
    }
}
