@extends('layouts.app')
@section('donatur', 'active')

@section('content')
    <div class="row">
        <div class="col">
            <div class="pt-4 d-flex justify-content-between">
                <h2>Info Donatur {{ $donatur->nama }}</h2>
                <div class="d-flex justify-content-center flex-wrap align-content-start">
                    <a href="{{ url('/donaturs/' . $donatur->id . '/edit') }}" class="btn btn-primary">Edit</a>
                    @can('delete', $donatur)
                        <form onsubmit="return confirm('Apa anda yakin akan menghapus ini?');"
                            action="{{ url('/donaturs/' . $donatur->id) }}" method="POST">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ms-3">Hapus</button>
                            @csrf
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <hr>

    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('pesan') }}
        </div>
    @endif

    <div class="table-responsive">

        <ul class="list-group list-group-numbered">
            <li class="list-group-item">Kode : {{ $donatur->kode }}</li>
            <li class="list-group-item">Nama : {{ $donatur->nama }}</li>
            <li class="list-group-item">Outlet : {{ $donatur->nama_outlet }}</li>
            <li class="list-group-item">No Rekening : {{ $donatur->no_rek }}</li>
            <li class="list-group-item">Alamat : {{ $donatur->alamat }}</li>
            <li class="list-group-item">No HP : {{ $donatur->no_hp }}</li>
            <li class="list-group-item d-flex flex-wrap" style="word-break: break-all;">Map :
                @if ($donatur->map != '-')
                    <a name="" id="" class="btn-link" target="_blank" href=" {{ $donatur->map }}"
                        role="button">
                        {{ $donatur->map }}</a>
                @endif

            </li>
            <li class="list-group-item">Jenis Kelamin : {{ $donatur->jenkel }}</li>
            <li class="list-group-item">Status : {{ $donatur->status == 1 ? 'Aktif' : 'No Aktif' }}</li>
            <li class="list-group-item">Donasi diambil : {!! ($donatur->transactions_count < 1 ) ? '<span class="text-danger">Belum</span>' : '<span class="text-success">Sudah</span>'  !!}</li>
            <li class="list-group-item">Tanggal Daftar : {{ $donatur->created_at->isoFormat('DD-MM-YYYY HH:mm') }}</li>
        </ul>
    </div>

    @component('tools.button', ['class' => 'info mt-2', 'link' => url('donaturs')])
        Kembali
    @endcomponent

    <a href="{{ route('transaksi-donatur', ['donatur_id' => $donatur->id]) }}" class="btn btn-success mt-2">Transasksi</a>
@endsection
