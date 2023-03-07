@extends('admin.layouts.template')
@section('page_title')
    Edit Product Image
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Edit Product Image</h4>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Edit Product Image</h5>
                        <small class="text-muted float-end">Input information</small>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.product_img') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Preview image</label>
                                <div class="col-sm-10">
                                    <img style="height: 400px" src="{{ asset($product_img_info->product_img) }}" alt="">
                                </div>
                            </div>
                            <input type="hidden" value="{{$product_img_info->id}}" name="id">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">
                                    Upload New Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" id="product_img" name="product_img" />
                                    @error('product_img')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Update Product Image</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
