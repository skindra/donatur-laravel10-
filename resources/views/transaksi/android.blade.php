@extends('layout.app')

@section('content')
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Form Transaksi </h1>
                    <p class="lead text-info fw-bold">
                        Silahkan isi data berikut
                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-3">

                            <form action="{{ url('send-donasi') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label" for="kodeDonatur">Kode Donatur</label>
                                    <input type="text" class="form-control " disabled name="kodeDonatur"
                                        value="{{ $donatur->kode }}" id="kodeDonatur">
                                    @error('donatur_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="donatur_id" value="{{ $donatur->id }}" id="donatur_id">


                                <div class="mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input id="nama" type="text"
                                        class="form-control @error('nama') is-invalid @enderror" name="nama"
                                        value="{{ $donatur->nama }}" readonly>

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
                                        value="{{ $donatur->nama_outlet }}" readonly>

                                    @error('nama_outlet')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea name="alamat" id="" class="form-control @error('alamat') is-invalid @enderror" cols="5"
                                        rows="3" readonly>{{ $donatur->alamat }}</textarea>

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
                                        value="{{ $donatur->no_hp }}" readonly>

                                    @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label class="form-label" for="nominal">Nominal</label>
                                    <input type="number" id="nominal" name="nominal" value="{{ old('nominal') }}"
                                        class="form-control @error('nominal') is-invalid @enderror">
                                    @error('nominal')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="keterangan">Keterangan</label>
                                    <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan') }}"
                                        class="form-control @error('keterangan') is-invalid @enderror">
                                    @error('keterangan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="user">Petugas</label>
                                    <select id="user" name="user_id"
                                        class="form-select @error('user_id') is-invalid @enderror ">
                                        @foreach ($user as $u)
                                            @if ($u->email != 'admin@gmail.com')
                                                <option value=" {{ $u->id }} ">{{ $u->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

