@extends('layouts.admin')

@section('content-header', $title ?? '')

@section('content')

    @include('alert')

    <div class="card">
        <div class="card-body mb-4">
            {!! $dataTable->table() !!}
        </div>
    </div>

@endsection

@push('scripts')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}

<script src="{{ asset('sweetalert/alert.js') }}"></script>
@endpush
