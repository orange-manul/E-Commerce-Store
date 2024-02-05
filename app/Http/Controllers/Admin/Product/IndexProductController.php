<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;

class IndexProductController extends BaseController
{

    public function __invoke()
    {
        $products = $this->productService->index();
        return view('admin.allproduct', compact('products'));

    }
}
