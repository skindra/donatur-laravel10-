@extends('layout.app')

@section('content')
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">

                    <img class="img w-25" src="/logo.png" alt="">
                    <h1 class="h2">Form Pendaftaran Donatur </h1>
                    <p class="lead text-info fw-bold">
                        Silahkan isi data berikut
                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-3">
                            <form method="POST" action="{{ route('form-pendaftaran') }}" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Kode</label>
                                    <input id="kode" type="text"
                                        class="form-control @error('kode') is-invalid @enderror" name="kode"
                                        value="{{ old('kode') }}" autofocus>

                                    @error('kode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input id="nama" type="text"
                                        class="form-control @error('nama') is-invalid @enderror" name="nama"
                                        value="{{ old('nama') }}" autofocus>

                                    @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Outlet</label>
                                    <input id="nama_outlet" type="text"
                                        class="form-control @error('nama_outlet') is-invalid @enderror" name="nama_outlet"
                                        value="{{ old('nama_outlet') }}" autofocus>

                                    @error('nama_outlet')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat" id="" class="form-control @error('alamat') is-invalid @enderror" cols="5"
                                        rows="3">{{ old('alamat') }}</textarea>

                                    @error('alamat')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No Hp</label>
                                    <input id="no_hp" type="text"
                                        class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                        value="{{ old('no_hp') }}">

                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">No Rekening</label>
                                    <p>BRI 4270-01-033419-53-8 an Yayasan Nurul Hadid</p>
                                    @error('no_rek')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Map</label>
                                    <input id="map" type="text"
                                        class="form-control @error('map') is-invalid @enderror" name="map"
                                        value="{{ old('map') }}">

                                    @error('map')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="jenkel" id="laki_laki"
                                            value="L" {{ old('jenkel') == 'L' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="laki_laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenkel" id="perempuan"
                                            value="P" {{ old('jenkel') == 'P' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perempuan">Perempuan</label>
                                    </div>


                                    @error('jenkel')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Daftar
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
