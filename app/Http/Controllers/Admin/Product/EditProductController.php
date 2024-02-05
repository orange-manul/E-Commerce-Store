<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Product;

class EditProductController extends BaseController
{

    public function __invoke($id)
    {
        $product_info = $this->productService->edit($id);

        return view('admin.editproduct', compact('product_info'));

    }
}
