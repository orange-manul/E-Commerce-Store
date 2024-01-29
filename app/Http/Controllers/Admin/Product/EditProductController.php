<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class EditProductController extends Controller
{

    public function __invoke($id)
    {
        $product_info = Product::findOrFail($id);

        return view('admin.editproduct', compact('product_info'));

    }
}
