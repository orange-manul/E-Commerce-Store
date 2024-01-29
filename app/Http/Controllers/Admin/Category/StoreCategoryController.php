<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreCategoryController extends Controller
{

    public function __invoke(Category $category, StoreCategoryRequest $request){
        $data = $request->validated($category);

        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);
        return redirect()->route('all.category')->with('message', 'Category Added Successfully');
    }
}
