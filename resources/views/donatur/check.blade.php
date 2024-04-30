@extends('layouts.app')
@section('cekDonatur', 'active')
@section('content')
    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('pesan') }}
        </div>
    @endif
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">Daftar Donatur</h5>
            <div>
                <a name="" id="" class="btn btn-primary" href="{{ route('donaturs.create') }}"
                    role="button">Tambah</a>
            </div>
        </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th class="d-xl-table-cell">#</th>
                            <th>Nama</th>
                            <th class="d-xl-table-cell">Jenis Kelamin</th>
                            <th>Status</th>
                            <th>No HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donaturs as $donatur)
                            <?php 
                            $status = $donatur->status == 1 ? 'primary' : 'secondary';

                            $is_check =($donatur->transactions_count < 1 ) ? "table-warning" : '';
                            ?>
                            <tr class="{{$is_check}}">
                                <td>{{ $donaturs->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="d-xl-table-cell">
                                    <a name="" id="" class=""
                                        href="{{ url('/donaturs/' . $donatur->id) }}" role="button">
                                        {{ $donatur->nama }}</a> {!! ($donatur->transactions_count < 1) ? '<span class="fs-6">Belum diambil</span>' : "" ; !!}

                                </td>
                                <td class="d-xl-table-cell">{{ $donatur->jenkel }}</td>
                                <td><span
                                        class="badge bg-{{ $status }}">{{ $donatur->status == 1 ? 'Aktif' : 'No Aktif' }}</span>
                                </td>
                                <td class="d-xl-table-cell">{{ $donatur->no_hp }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data...</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="mt-3">
                {{ $donaturs->onEachSide(2)->links() }}
            </div>
        </div>
    </div>
@endsection
