<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\Image\UpdateProductImgRequest;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::latest()->get();
        return view('admin.allproduct', compact('products'));
    }

    public function addProduct()
    {

        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        return view('admin.addproduct', compact('categories', 'subcategories'));
    }

    public function storeProduct(StoreProductRequest $request)
    {

        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'product_short_desc' => $request->product_short_desc,
            'product_long_desc' => $request->product_long_desc,
            'price' => $request->price,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_img' => $img_url,
            'quantity' => $request->quantity,
            'slug' => strtolower(str_replace(' ', '-', $request->product_name)),
        ]);

        Category::where('id', $category_id)->increment('product_count', 1);
        Subcategory::where('id', $subcategory_id)->increment('product_count', 1);

        return redirect()->route('all.product')->with('message', 'Product Added Successfully');
    }

    public function editProductImg($id)
    {
        $product_img_info = Product::findOrFail($id);
        return view('admin.editproductimg', compact('product_img_info'));
    }

    public function updateProductImg(UpdateProductImgRequest $request)
    {

        $id = $request->id;
        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        Product::findOrFail($id)->update(['product_img' => $img_url]);

        return redirect()->route('all.product')->with('message', 'Product Image Update Successfully');
    }

    public function editProduct($id)
    {
        $product_info = Product::findOrFail($id);

        return view('admin.editproduct', compact('product_info'));
    }

    public function updateProduct(UpdateProductRequest $request)
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

    public function deleteProduct($id)
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
