<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;

class AddProductController extends BaseController
{

    public function __invoke()
    {
        $categories = $this->productService->getAllCategories();
        $subcategories = $this->productService->getAllSubCategories();

        return view('admin.addproduct', compact('categories', 'subcategories'));

    }
}
