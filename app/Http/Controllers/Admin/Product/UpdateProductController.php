<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Product\UpdateProductRequest;

class UpdateProductController extends BaseController
{

        public function __invoke(UpdateProductRequest $request)
    {

        $productId = $request->id;
        $data = $request->validated();
        $this->productService->update($data, $productId);

        return redirect()->route('all.product')->with('message', 'Product Update Successfully');

    }
}
