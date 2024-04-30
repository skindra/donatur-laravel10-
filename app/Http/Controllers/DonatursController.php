<?php

namespace App\Http\Controllers;

use App\Models\Donatur as Donaturs;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DaftarDonatur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Models\FormRequest;

class DonatursController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('donatur.index', ['donaturs' => Donaturs::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('donatur.form-donatur', []);
    }
    // kode dibuat dengan otomatis
    public function create2()
    {
        $uniq = Str::random(10);
        /* cek dulu data formrequest */
        $data_forms = FormRequest::where('uniq', session('iduniq'))->first();
        // jika data ada
        if ($data_forms) {
            if ($data_forms->is_aktif === 0) {
                if ($data_forms->kode_donatur == 0) {
                    $nomor = sprintf("%04d", $data_forms->id);
                    FormRequest::where('uniq', session('iduniq'))->first()->update([
                        'kode_donatur' => "A" . $nomor
                    ]);
                    return redirect('/donaturs/create');
                } else {
                    return view('donatur.form-donatur', ['form_request' => $data_forms]);
                }
            } else {
                session(['iduniq' => $uniq]);
                FormRequest::create(
                    [
                        'uniq' => $uniq,
                        'is_aktif' => false,
                    ]
                );
                return redirect('/donaturs/create');
            }
        } else {
            // simpan ke formrequest
            FormRequest::create(
                [
                    'uniq' => $uniq,
                    'is_aktif' => false,
                ]
            );
            session(['iduniq' => $uniq]);
            return redirect('/donaturs/create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate(
            [
                'nama' => 'required',
                'alamat' => '',
                'no_hp' => 'required|numeric',
                'status' => 'required|in:1,0',
                'jenkel' => 'required:in:L,P',
                'kode' => 'required|alpha_num|min:5|unique:donaturs',
                'nama_outlet' => 'required',
                'map' => '',
                'no_rek' => '',
            ]
        );

        Donaturs::create($validateData);
        return redirect('/donaturs')->with('pesan', 'Donatur ' . $request->nama . " berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Donaturs $donatur): Response
    {
        $donatur->loadCount('transactions');
        return response()->view('donatur.show', compact('donatur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donaturs $donatur): Response
    {
        return response()->view('donatur.edit', compact('donatur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DaftarDonatur $request, Donaturs $donatur): RedirectResponse
    {
        $validateData = $request->validated();

        $donatur->update($validateData);
        return redirect('/donaturs/' . $donatur->id)->with('pesan', 'Donatur ' . $request->nama . ' Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donaturs $donatur): RedirectResponse
    {
        // batasi hak akses untuk proses store
        $this->authorize('delete', $donatur);
        $donatur->delete();
        return redirect('/donaturs')->with('pesan', 'Donatur ' . $donatur->nama . ' Berhasil dihapus');
    }

    public function kodeDonatur()
    {
        $data = Donaturs::where('kode', 'LIKE', '%' . request('q') . '%')->orWhere('nama', 'LIKE', '%' . request('q') . '%')->paginate(10);
        return response()->json($data);
    }

    public function namaDonatur($id)
    {
        $data = Donaturs::where('')->where('kode', 'LIKE', '%' . request('q') . '%')->paginate(10);
        return response()->json();
    }

    function checkDonatur():Response
    {
        $donaturs = Donaturs::withCount('transactions')->paginate(5);

        // dd($donaturs->toArray());
        return response()->view('donatur.check', compact('donaturs'));
    }

}
