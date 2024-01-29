<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexProductController extends Controller
{

    public function __invoke()
    {
        $products = Product::latest()->get();
        return view('admin.allproduct', compact('products'));

    }
}
