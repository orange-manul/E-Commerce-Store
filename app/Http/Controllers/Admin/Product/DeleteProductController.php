<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class DeleteProductController extends Controller
{

    public function __invoke($id)
    {
        $cat_id = Product::where('id', $id)->value('product_category_id');
        $subcategory_id = Product::where('id', $id)->value('product_subcategory_id');
        Product::findOrFail($id)->delete();

        Category::where('id', $cat_id)->decrement('product_count', 1);
        Subcategory::where('id', $subcategory_id)->decrement('product_count', 1);
//        Subcategory::where('id', $subcat_id)->decrement('product_count, 1');

        return redirect()->route('all.product')->with('message', 'Product Delete Successfully');

    }
}
