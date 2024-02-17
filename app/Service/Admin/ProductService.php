<?php

namespace App\Service\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function index()
    {
        return Product::latest()->get();
    }

    public function getAllCategories()
    {
        return Category::latest()->get();
    }

    public function getAllSubCategories()
    {
        return Subcategory::latest()->get();
    }

    public function delete($id): void
    {
        $product = Product::findOrFail($id);

        Category::where('id', $product->product_category_id)->decrement('product_count', 1);
        Subcategory::where('id', $product->product_subcategory_id)->decrement('product_count', 1);

        // You can use SoftDeletes to return the product
        $product->delete();
    }

    public function edit($id)
    {
        return Product::findOrFail($id);
    }

    public function editImage($id)
    {
        return Product::findOrFail($id);
    }

    public function updateImage(array $data, $id): void
    {
        $image = $data['product_img'];
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        Product::findOrFail($id)->update(['product_img' => $img_url]);
    }

    public function store(array $data, UploadedFile $image)
    {
        DB::transaction(function () use ($data, $image){
            try {
                $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('upload'), $img_name);
                $img_url = 'upload/' . $img_name;

                $category_id = $data['product_category_id'];
                $subcategory_id = $data['product_subcategory_id'];

                $category_name = Category::where('id', $category_id)->value('category_name');
                $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

                Product::insert([
                    'product_name' => $data['product_name'],
                    'product_short_desc' => $data['product_short_desc'],
                    'product_long_desc' => $data['product_long_desc'],
                    'price' => $data['price'],
                    'product_category_name' => $category_name,
                    'product_subcategory_name' => $subcategory_name,
                    'product_category_id' => $data['product_category_id'],
                    'product_subcategory_id' => $data['product_subcategory_id'],
                    'product_img' => $img_url,
                    'quantity' => $data['quantity'],
                    'slug' => strtolower(str_replace(' ', '-', $data['product_name'])),
                ]);

                Category::where('id', $category_id)->increment('product_count', 1);
                Subcategory::where('id', $subcategory_id)->increment('product_count', 1);

            } catch (\Exception $e) {
                DB::rollBack();
                abort(500);
            }
        });
    }

    public function update(array $data, $productId)
    {
        try {

            $product = Product::findOrFail($productId);

            return $product->update([
                'product_name' => $data['product_name'],
                'product_short_desc' => $data['product_short_desc'],
                'product_long_desc' => $data['product_long_desc'],
                'price' => $data['price'],
                'quantity' => $data['quantity'],
                'slug' => strtolower(str_replace(' ', '-', $data['product_name'])),
            ]);
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }


}
