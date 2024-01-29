<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class IndexSubCategoryController extends Controller
{
    public function __invoke(Request $request)
    {
        $subcategories = Subcategory::latest()->get();

        return view('admin.allsubcategory', compact('subcategories'));

    }
}
