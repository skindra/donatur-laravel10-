@extends('layouts.app')
@section('laporan', 'active')


@section('content')

    <div class="card flex-fill">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title mb-0">Daftar Transaksi {{ $user ?? 'Semua' }} </h5>
            <div>
                <a name="" id="" class="btn btn-primary" href="{{ route('transactions.create') }}"
                    role="button">Tambah</a>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover my-0 table-striped">
                    <thead>
                        <tr>
                            <th class="d-xl-table-cell">#</th>
                            <th>Nama</th>
                            <th class="d-xl-table-cell">Nominal</th>
                            <th>Status</th>
                            <th>Petugas</th>
                            <th class="text-center">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $transactions->firstItem() + $loop->iteration - 1 }}</td>
                                <td class="d-xl-table-cell">
                                    <a name="" data-bs-judul="{{ strtoupper($transaction->donatur->nama) }}"
                                        id="tombol" data-bs-toggle="modal" data-bs-target="#exampleModal" class=""
                                        href="{{ url('/transactions/' . $transaction->id) }}"
                                        data-id="{{ $transaction->id }}" role="button">
                                        {{ strtoupper($transaction->donatur->nama) }}</a>

                                </td>
                                <td class="d-xl-table-cell">@currency($transaction->nominal)</td>
                                <td>

                                    @switch($transaction->status)
                                        @case('rekam')
                                            <span class="badge bg-secondary">{{ $transaction->status }}</span>
                                        @break

                                        @case('validasi')
                                            <span class="badge bg-primary">{{ $transaction->status }}</span>
                                        @break

                                        @default
                                            <span class="badge bg-success">{{ $transaction->status }}</span>
                                    @endswitch
                                    </span>
                                </td>
                                <td class="d-xl-table-cell">{{ $transaction->user->name }}</td>
                                <td class="d-xl-table-cell text-center">
                                    {{ $transaction->created_at->isoFormat('DD-MM-YYYY HH:mm') }}</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data...</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="card-footer">
                <div class="mt-3">
                    {{ $transactions->onEachSide(2)->links() }}
                </div>
            </div>
        </div>
        @isset($user)
            @component('tools.button', ['class' => 'warning text-dark', 'link' => url()->previous()])
                Kembali
            @endcomponent

        @endisset

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="judulModal">Detail Transaksi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    @endsection


    @section('javascript')
        <script>
            $("document").ready(function() {
                $('#exampleModal').on('shown.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var modal = $(this);
                    const judul = button.attr('data-bs-judul')
                    modal.find('#judulModal').text(' Detail Transaksi ' + judul);

                    // Load content from the specified URL
                    modal.find('.modal-body').load(button.attr('href'));
                });

                $('#exampleModal').on('hidden.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var modal = $(this);
                    modal.find('.modal-body').empty();
                });


            })
        </script>

    @endsection
