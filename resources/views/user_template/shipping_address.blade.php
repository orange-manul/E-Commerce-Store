@extends('user_template.layouts.template')
@section('main-content')
    <h1>Provide your shipping address</h1>
    <div class="row">
        <div class="col-12">
            <div class="box_main">
                <form action="{{ route('add_shipping_address') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="phone_number">Phone number</label>
                        <input type="text" class="form-control" name="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="city_name">City/Village name</label>
                        <input type="text" class="form-control" name="city_name">
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal code</label>
                        <input type="text" class="form-control" name="postal_code">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Next">
                </form>
            </div>
        </div>
    </div>
@endsection
