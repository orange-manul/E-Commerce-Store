<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class DeleteSubcategoryController extends Controller
{
    public function __invoke($id)
    {
        $cat_id = Subcategory::where('id', $id)->value('category_id');
        Subcategory::findOrFail($id)->delete();
        Category::where('id', $cat_id)->decrement('subcategory_count', 1);

        return redirect()->route('all.subcategory')->with('message', 'Sub Category Deleted Successfully');

    }
}
