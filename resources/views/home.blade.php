@extends('layouts.app')
@section('home', 'active')
@section('content')
    <div class="row">
        @foreach ($user as $u)
            <div class="col-4">
                <div class="card border-success" style="max-width: 18rem;">
                    <div class="card-header bg-success text-light border-success">{{ strtoupper($u->name) }} </div>
                    <div class="card-body text-success">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            @can('update', $u)
                                <a name="" id="" class="btn btn-sm rounded btn-primary"
                                    href="{{ url('user/' . $u->id) }}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    role="button" data-bs-judul="{{ $u->name }}">Lihat</a>
                            @endcan


                            <a name="" id="" class="btn btn-sm rounded btn-info"
                                href="{{ route('transaksi-user', ['user_id' => $u->id]) }}" role="button">Transaksi</a>
                        </div>
                    </div>
                    <div class="card-footer bg-secondary border-success text-center text-light">
                        {{ $u->created_at->isoFormat('DD-MM-YYYY HH:mm') }} </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="judulModal">Detail User</h1>
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
                modal.find('#judulModal').text(' Detail User ' + judul);

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
