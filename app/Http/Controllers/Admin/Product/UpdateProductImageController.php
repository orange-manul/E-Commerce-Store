<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\Image\UpdateProductImgRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class UpdateProductImageController extends Controller
{

    public function __invoke(UpdateProductImgRequest $request)
    {
        $id = $request->id;
        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        Product::findOrFail($id)->update(['product_img' => $img_url]);

        return redirect()->route('all.product')->with('message', 'Product Image Update Successfully');

    }
}
