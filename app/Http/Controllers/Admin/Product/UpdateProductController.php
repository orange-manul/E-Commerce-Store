<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class UpdateProductController extends Controller
{

    public function __invoke(UpdateProductRequest $request)
    {
        $productId = $request->id;

        Product::findOrFail($productId)->update([
            'product_name' => $request->product_name,
            'product_short_desc' => $request->product_short_desc,
            'product_long_desc' => $request->product_long_desc,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
        ]);

        return redirect()->route('all.product')->with('message', 'Product Update Successfully');

    }
}
