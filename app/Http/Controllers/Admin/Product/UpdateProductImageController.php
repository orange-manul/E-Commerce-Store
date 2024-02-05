<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Product\Image\UpdateProductImgRequest;

class UpdateProductImageController extends BaseController
{

    public function __invoke(UpdateProductImgRequest $request)
    {
        $id = $request->id;
        $data = $request->validated();
        $this->productService->updateImage($data, $id);

        return redirect()->route('all.product')->with('message', 'Product Image Update Successfully');

    }
}
