<?php

namespace App\Service\Home;

use App\Models\Product;

class ProductService
{
    public function index()
    {
         return Product::latest()->get();

    }
}
