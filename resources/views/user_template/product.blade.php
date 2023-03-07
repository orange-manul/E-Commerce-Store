@extends('user_template.layouts.template')
@section('main-content')

    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <img src="{{ asset($product->product_img) }}" alt="">
            </div>
            <div class="col-lg-8">
                <div class="box_main">
                    <div class="product-info">
                        <h4 class="shirt_text text-left">{{ $product->product_name }}</h4>
                        <p class="price_text text-left">Price <span
                                style="color: #262626;">$ {{ $product->price }}</span></p>
                    </div>
                    <div class="my-3 product-details">
                        <p class="lead">{{ $product->product_long_desc }}</p>
                        <ul class="p-2 bg-light my-2">
                            <li>Category - {{ $product->product_category_name }}</li>
                            <li>Sub category - {{ $product->product_subcategory_name }}</li>
                            <li>Available quantity - {{ $product->quantity }}</li>
                        </ul>
                    </div>
                    <div class="btn_main">
                        <form action="{{ route('add_product_to_cart') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <input type="hidden" value="{{ $product->price }}" name="price">
                            <input type="hidden" value="1" name="quantity">
                            <div class="form-group">
                                <label for="product_quantity">How many pics?</label>
                                <input class="form-control" type="number" min="1" placeholder="1"
                                       name="quantity">
                            </div>
                            <br>
                            <input class="btn btn-warning" type="submit" value="Add to cart">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="fashion_section mt-5">
        <div id="main_slider">
            <div class="container">
                <h1 class="fashion_taital">Related products</h1>
                <div class="fashion_section_2">
                    <div class="row">
                        @foreach($related_products as $product)
                            <div class="col-lg-4 col-sm-4">
                                <div class="box_main">
                                    <h4 class="shirt_text">{{ $product->product_name }}</h4>
                                    <p class="price_text">Price <span
                                            style="color: #262626;">$ {{ $product->price }}</span></p>
                                    <div class="tshirt_img"><img style="height: 350px" src="{{ asset($product->product_img) }}"
                                                                 alt=""></div>
                                    <div class="btn_main">
                                        <div class="buy_bt">
                                        <form action="{{ route('add_product_to_cart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                                            <br>
                                            <input class="btn btn-warning" type="submit" value="Buy now">
                                        </form>
                                        <div class="seemore_bt">
                                            <a href="{{ route('single_product', [$product->id, $product->slug]) }}">
                                                See More</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        <a class="carousel-control-prev" href="#main_sliders" role="button" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control-next" href="#main_sliders" role="button" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>


    </div>

@endsection
