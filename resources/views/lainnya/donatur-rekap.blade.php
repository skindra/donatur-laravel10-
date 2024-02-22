@extends('layouts.app')
@section('donatur-rekap', 'active')

@section('content')

    @if (session()->has('pesan'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('pesan') }}
        </div>
    @endif
    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">Rekap Donatur</h5>
            <div>
                <a name="" id="" class="btn btn-primary" href="{{ route('transactions.create') }}"
                    role="button"> <i class="align-middle" data-feather="plus"></i> <span
                        class="align-middle">Tambah</span></a>
                @can('create', App\Models\User::class)
                    <a name="" id="" class="btn btn-success" href="{{ route('transactions.export') }}"
                        role="button"> <i class="align-middle" data-feather="download"></i> <span
                            class="align-middle">Export</span></a>
                @endcan
            </div>
        </div>

        <div class="card-body" id="judul">
            <div class="table-responsive">
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
                            <th class="d-xl-table-cell">#</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th class="d-xl-table-cell">Outlet</th>
                            <th>Petugas</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donatur as $d)
                            <tr>
                                <td>{{ $donatur->firstItem() + $loop->iteration - 1 }}</td>
                                <td>{{ $d->kode }} </td>
                                <td>{!! (count($d->transactions) === 1 ) ? $d->nama : "<a href='".route('transaksi-donatur',['donatur_id' => $d->id])."' class='text-danger' >".$d->nama."</a>"  !!}</td>
                                <td>{{ $d->nama_outlet }}</td>
                                <td>
                                    @php

                                        echo count($d->transactions) . ' Petugas';
                                    @endphp

                                    {{-- {{implode('',$d->transactions->user->name)}} --}}
                                </td>
                                <td> @currency($d->transactions->sum('nominal'))</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"> Kosong</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="5"> Total :</td>
                            <td> @currency($transaction[0]->sum ?? 0) </td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                {{ $donatur->fragment('judul')->links() }}</td>
                        </tr>

                    </tfoot>
                </table>

            </div>

        </div>
        <div class="card-footer">
            <div class="mt-3">
            </div>
        </div>
    </div>

@endsection
