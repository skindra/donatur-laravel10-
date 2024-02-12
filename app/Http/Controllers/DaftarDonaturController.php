<?php

namespace App\Http\Controllers;

use App\Models\Donatur as Donaturs;
use App\Models\FormRequest;
// use Illuminate\Http\Request;
use App\Http\Requests\DaftarDonatur;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DaftarDonaturController extends Controller
{

    public function index()
    {
        return view('pendaftaran', []);
    }
    // index dengan kode dibuat otomatis;
    public function index2()
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
                    return redirect('/form-pendaftaran');
                } else {
                    return view('pendaftaran', ['form_request' => $data_forms]);
                }
            } else {
                session(['iduniq' => $uniq]);
                FormRequest::create(
                    [
                        'uniq' => $uniq,
                        'is_aktif' => false,
                    ]
                );
                return redirect('/form-pendaftaran');
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
            return redirect('/form-pendaftaran');
        }
        // dd($data_forms);
    }

    public function daftar(DaftarDonatur $request)
    {
        // $validationData = Validator::make($request->all(), $ruledonatur,[]);
        $validateData = $request->validated();

        // dump($validationData);
        FormRequest::where('uniq', session('iduniq'))->first()->update([
            'is_aktif' => true,
        ]);
        if (!Donaturs::create($validateData)) {
            return redirect('/form-pendaftaran');
        };
        session()->flash('pesan', 'Data ' . $request->nama . ' berhasil disimpan');
        return redirect('status');
    }
}
