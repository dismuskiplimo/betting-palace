@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-3">@include('pages.admin.includes.sidebar')</div>
            <div class="col-sm-9">
                <h4 class="text-warning mb-3">{{ $title }}</h4>
            </div>
        </div>
    </div>
@endsection