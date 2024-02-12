@extends('layouts.app')
@section('donatur', 'active')

@section('content')
    <h1>Pendaftaran Donatur</h1>

    <hr>
    <form action="{{ route('donaturs.store') }}" method="POST">
        @csrf
        <div class="mb-3">

            <label class="form-label" for="kode">Kode</label>
            <input type="text" id="kode" name="kode" value="{{ old('kode') }}"
                class="form-control text-uppercase @error('kode') is-invalid @enderror" autofocus>
            @error('kode')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                class="form-control @error('nama') is-invalid @enderror">
            @error('nama')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Outlet</label>
            <input id="nama_outlet" type="text" class="form-control @error('nama_outlet') is-invalid @enderror"
                name="nama_outlet" value="{{ old('nama_outlet') }}" >

            @error('nama_outlet')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label" for="no_hp">No HP</label>
            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                class="form-control @error('no_hp') is-invalid @enderror">
            @error('no_hp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">No Rekening</label>
            <input id="no_rek" type="text" class="form-control @error('no_rek') is-invalid @enderror" name="no_rek"
                value="{{ old('no_rek') }}">
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
                value="{{ old('map') }}">

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
                        {{ old('jenkel') == 'L' ? 'checked' : '' }}>
                    <label class="form-check-label" for="laki_laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenkel" id="perempuan" value="P"
                        {{ old('jenkel') == 'P' ? 'checked' : '' }}>
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
                        {{ old('status') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="aktif">Aktif</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="no-aktif" value="0"
                        {{ old('status') == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="no-aktif">No Aktif</label>
                </div>
            </div>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-2">Daftar</button>
    </form>
@endsection
