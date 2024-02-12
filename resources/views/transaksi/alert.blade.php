@extends('layout.app')

@section('content')
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">
                <div class="alert alert-success" role="alert">
                    {{ $pesan }}
                </div>
            </div>

        </div>
    </div>
@endsection
