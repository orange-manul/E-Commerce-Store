@extends('user_template.layouts.template')
@section('main-content')

    <h2>Final step to place your order</h2>

    <div class="row">
        <div class="col-8">
            <div class="box_main">
                <h3>
                Product will send at
                </h3>
                <p>Phone number - {{ $shipping_address->phone_number }}</p>
                <p>City - {{ $shipping_address->city_name }}</p>
                <p>Postal code - {{ $shipping_address->postal_code }}</p>
            </div>
        </div>

        <div class="col-4">
            <div class="box_main">
                Your final products are -
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
                                        </tr>
                                        @php
                                            $total = $total + $item->price;
                                        @endphp
                                    @endforeach
                                        <tr>
                                            <td></td>
                                            <td class="fw-bold">Total</td>
                                            <td> ${{ $total }}</td>
                                        </tr>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('place_order') }}" method="POST">
            @csrf
            <input type="submit" class="btn btn-primary mr-3" value="Place order">
        </form>
        <form action="" method="POST">
            @csrf
            <input type="submit" class="btn btn-danger" value="Cancel order">
        </form>

    </div>
@endsection
