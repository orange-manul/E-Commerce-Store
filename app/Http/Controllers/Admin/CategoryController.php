<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.allcategory', compact('categories'));
    }

    public function addCategory(){
        return view('admin.addcategory');
    }

    public function storeCategory(Category $category, StoreCategoryRequest $request){
        $data = $request->validated($category);

        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);
        return redirect()->route('all.category')->with('message', 'Category Added Successfully');
    }

    public function editCategory($id){
        $category_info = Category::findOrFail($id);

        return view('admin.editcategory', compact('category_info'));
    }

    public function updateCategory(Category $category, UpdateCategoryRequest $request){
        $data = $request->validated($category);

        $category_id = $request->category_id;

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace(' ', '-', $request->category_name))
        ]);

        return redirect()->route('all.category')->with('message', 'Category Updated Successfully');
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('all.category')->with('message', "Category Delete Successfully");
    }
}

