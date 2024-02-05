<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;

class EditProductImageController extends BaseController
{

    public function __invoke($id)
    {
        $product_img_info = $this->productService->editImage($id);
        return view('admin.editproductimg', compact('product_img_info'));

    }
}
