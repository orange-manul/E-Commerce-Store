<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class UpdateCategoryController extends Controller
{

    public function __invoke(Category $category, UpdateCategoryRequest $request){
        $data = $request->validated($category);

        $category_id = $request->category_id;

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);

        return redirect()->route('all.category')->with('message', 'Category Updated Successfully');
    }
}
