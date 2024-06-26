@extends('layouts.app')
@section('donatur', 'active')

@section('content')
    <h1>Edit Donatur</h1>
    <hr>
    <form action="{{ route('donaturs.update', ['donatur' => $donatur->id]) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Kode</label>
            <input type="hidden" name="kode" value=" {{ $donatur->kode }}">
            <input id="kode" type="text" class="form-control @error('kode') is-invalid @enderror" name=""
                value="{{ old('kode') ?? $donatur->kode }}" autofocus>

            @error('kode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') ?? $donatur->nama }}"
                class="form-control @error('nama') is-invalid @enderror">
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Outlet</label>
            <input id="nama_outlet" type="text" class="form-control @error('nama_outlet') is-invalid @enderror"
                name="nama_outlet" value="{{ old('nama_outlet') ?? $donatur->nama_outlet }}" autofocus>

            @error('nama_outlet')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ old('alamat') ?? $donatur->alamat }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label" for="no_hp">No HP</label>
            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') ?? $donatur->no_hp }}"
                class="form-control @error('no_hp') is-invalid @enderror">
            @error('no_hp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">No Rekening</label>
            <input id="no_rek" type="text" class="form-control @error('no_rek') is-invalid @enderror" name="no_rek"
                value="{{ old('no_rek') ?? $donatur->no_rek }}">
            <div id="passwordHelpBlock" class="form-text">
                Jika kosong di isi ' - '
            </div>
            @error('no_rek')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Map</label>
            <input id="map" type="text" class="form-control @error('map') is-invalid @enderror" name="map"
                value="{{ old('map') ?? $donatur->map }}">

            @error('map')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <div class="d-flex">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="jenkel" id="laki_laki" value="L"
                        {{ old('jenkel') ?? $donatur->jenkel == 'L' ? 'checked' : '' }}>
                    <label class="form-check-label" for="laki_laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenkel" id="perempuan" value="P"
                        {{ old('jenkel') ?? $donatur->jenkel == 'P' ? 'checked' : '' }}>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            @error('jenkel')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="d-flex">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="status" id="aktif" value="1"
                        {{ old('status') ?? $donatur->status == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="aktif">Aktif</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="no-aktif" value="0"
                        {{ old('status') ?? $donatur->status == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="no-aktif">No Aktif</label>
                </div>
            </div>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Edit</button>
            @component('tools.button', ['class' => 'info rounded', 'link' => url('donaturs')])
                Kembali
            @endcomponent
        </div>
    </form>


@endsection
