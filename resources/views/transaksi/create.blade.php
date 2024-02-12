@extends('layouts.app')
@section('laporan', 'active')

@section('content')
    <h1>Tambah Transaksi</h1>
    <hr>
    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label" for="kodeDonatur">Kode Donatur</label>
            <select id="kodeDonatur" name="donatur_id" class="form-select @error('donatur_id') is-invalid @enderror ">
            </select>
            @error('donatur_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <input type="hidden" name="nama" value="" id="nama">
        <div class="mb-3">
            <label class="form-label" for="keterangan">Keterangan</label>
            <input type="text" id="keterangan" name="keterangan" value="{{ old('keterangan') }}"
                class="form-control @error('keterangan') is-invalid @enderror">
            @error('keterangan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label class="form-label" for="nominal">Nominal</label>
            <input type="text" id="nominal" name="nominal" value="{{ old('nominal') }}"
                class="form-control @error('nominal') is-invalid @enderror">
            @error('nominal')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <div class="d-flex">
                <select class="form-select" name="status" aria-label="Default select example">
                    <option value="" selected>Daftar</option>
                    <option value="rekam" {{ old('status') == 'rekam' ? 'selected' : '' }}>Rekam</option>

                    <option value="validasi" {{ old('status') == 'validasi' ? 'selected' : '' }}>Validasi</option>
                    <option value="setuju" {{ old('status') == 'setuju' ? 'selected' : '' }}>Setuju</option>
                </select>
            </div>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary mb-2">Simpan</button>
    </form>


@endsection

@section('javascript')


    <script>
        $('document').ready(function() {
            $('#kodeDonatur').select2({
                placeholder: 'Pilih Donatur',
                ajax: {
                    url: "{{ route('kode-donatur') }}",
                    processResults: function({
                        data
                    }) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.kode + " | " + item.nama,
                                }
                            })
                        }
                    }
                },
                formatResult: function(element) {
                    return element.text + ' (' + element.id + ')';
                    // console.log(element);
                },

            });

            $('#kodeDonatur').change(function(data) {
                var data_nama = $("#kodeDonatur option:selected").text();
                const nama = data_nama.split('|')
                $("#nama").val(nama[1]);
            });

        })
    </script>
@endsection
