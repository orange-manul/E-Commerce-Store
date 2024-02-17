@extends('admin.layouts.template')
@section('page_title')
    Dashboard Ecommerce
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span>Admin main page</h4>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Welcome to the Admin panel</h5>
                <p class="card-text">Here you can create categories, subcategories, products, accept orders or cancel. You can also edit products,
                    categories and subcategories</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5>Route to home page</h5>
                <ul>
                    <li><a class="btn btn-primary" href="{{ route('index.home') }}">Home</a></li>
                </ul>
            </div>
        </div>
    </div>



@endsection
