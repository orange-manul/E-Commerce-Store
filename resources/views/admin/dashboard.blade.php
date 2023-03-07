@extends('admin.layouts.template')
@section('page_title')
    Dashboard Ecomm
@endsection
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Admin main page</h4>
            <ul>
                <li><a class="btn btn-primary" href="{{ route('index.home') }}">User home</a></li>
            </ul>
    </div>
@endsection
