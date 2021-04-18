@extends('layouts.app')

@section('content-header', $title ?? '')
@section('content')
    <div class="card py-4">
        <div class="card-body">
            @auth('lecturer')
                tes
            @endauth
        </div>
    </div>
@endsection
