<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\Admin\SubCategory\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(){
        $subcategories = Subcategory::latest()->get();

        return view('admin.allsubcategory', compact('subcategories'));
    }

    public function addSubCategory()
    {
        $categories = Category::latest()->get();

        return view('admin.addsubcategory', compact('categories'));
    }

    public function storeSubCategory(StoreSubCategoryRequest $request){
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


    public function editSubCategory($id){
        $subcategory_info = Subcategory::findOrFail($id);

        return view('admin.editsubcategory', compact('subcategory_info'));
    }

    public function updateSubCategory(UpdateSubCategoryRequest $request){
        $subcategory_id = $request->subcategory_id;

        Subcategory::findOrFail($subcategory_id)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
        ]);

        return redirect()->route('all.subcategory')->with('message', 'Sub Category Update Successfully');
    }

    public function deleteSubCategory($id){
        $cat_id = Subcategory::where('id', $id)->value('category_id');
        Subcategory::findOrFail($id)->delete();
        Category::where('id', $cat_id)->decrement('subcategory_count', 1);

        return redirect()->route('all.subcategory')->with('message', 'Sub Category Deleted Successfully');

    }
}

