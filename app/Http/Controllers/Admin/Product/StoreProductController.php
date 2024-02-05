<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use Illuminate\Http\RedirectResponse;

class StoreProductController extends BaseController
{

    public function __invoke(StoreProductRequest $request): RedirectResponse
    {
        $this->productService->store($request->validated(),$request->file('product_img'));

        return redirect()->route('all.product')->with('message', 'Product Added Successfully');

    }

}
