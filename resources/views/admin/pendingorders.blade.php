@extends('admin.layouts.template')
@section('page_title')
    Pending Orders
@endsection
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-title">
                <h1 class="text-center">Pending order</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>User id</th>
                        <th>Shipping information</th>
                        <th>Product id</th>
                        <th>Quantity</th>
                        <th>Total will pay</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @foreach($pendingOrders as $order)
                        <tr>
                            <td>{{ $order->userId }}</td>
                            <td>
                                <ul>
                                    <li>Phone number {{ $order->phone_number }}</li>
                                    <li>City - {{ $order->shipping_city }}</li>
                                    <li>Postal code - {{ $order->shipping_postalCode }}</li>
                                </ul>
                            </td>
                            <td>{{ $order->product_id }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->status }}</td>
                            <td><a href="" class="btn btn-success">Approved now</a></td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
