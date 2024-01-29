<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class EditProductImageController extends Controller
{

    public function __invoke($id)
    {
        $product_img_info = Product::findOrFail($id);
        return view('admin.editproductimg', compact('product_img_info'));

    }
}
