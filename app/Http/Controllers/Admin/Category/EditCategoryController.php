<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class EditCategoryController extends Controller
{

    public function __invoke($id)
    {
        $category_info = Category::findOrFail($id);

        return view('admin.editcategory', compact('category_info'));

    }
}
