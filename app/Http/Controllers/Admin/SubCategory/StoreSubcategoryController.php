<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategory\StoreSubCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class StoreSubCategoryController extends Controller
{

    public function __invoke(StoreSubCategoryRequest $request)
    {
        $category_id = $request->category_id;

        $category_name = Category::where('id', $category_id)->value('category_name');

        Subcategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace('', '-', $request->subcategory_name)),
            'category_id' => $category_id,
            'category_name' => $category_name,
        ]);

        Category::where('id', $category_id)->increment('subcategory_count',1);

        return redirect()->route('all.subcategory')->with('message', 'Sub Category Added Successfully');

    }
}
