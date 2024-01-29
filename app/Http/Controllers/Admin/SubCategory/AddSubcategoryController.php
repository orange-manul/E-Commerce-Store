<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AddSubCategoryController extends Controller
{

    public function __invoke(Request $request)
    {
        $categories = Category::latest()->get();

        return view('admin.addsubcategory', compact('categories'));

    }
}
