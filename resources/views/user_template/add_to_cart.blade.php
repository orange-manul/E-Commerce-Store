@extends('user_template.layouts.template')
@section('main-content')

    <h2 class="py-5">Add to cart</h2>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="box-main">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Product image</th>
                            <th>Product name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($cart_items as $item)
                            <tr>
                                @php
                                    $product_name = App\Models\Product::where('id', $item->product_id)
                                    ->value('product_name');
                                    $product_img = App\Models\Product::where('id', $item->product_id)
                                    ->value('product_img');
                                @endphp
                                <td><img style="height: 50px"
                                         src="{{ asset($product_img) }}" alt=""></td>
                                <td>{{ $product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td><a href="{{ route('remove_cart_item', $item->id) }}" class="btn btn-warning">Remove</a></td>
                            </tr>
                            @php
                                $total = $total + $item->price;
                            @endphp
                        @endforeach
                        @if($total > 0)
                        <tr>
                            <td class="fw-bold">Total</td>
                            <td> ${{ $total }}</td>
                            <td><a href="{{ route('shipping_address') }}" class="btn btn-primary">Checkout now</a></td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
