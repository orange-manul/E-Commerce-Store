<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\RedirectResponse;

class DeleteProductController extends BaseController
{

    public function __invoke($id): RedirectResponse
    {

        $this->productService->delete($id);

        return redirect()->route('all.product')->with('message', 'Product Delete Successfully');

    }

}
