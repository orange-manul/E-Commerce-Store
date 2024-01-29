<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class EditSubcategoryController extends Controller
{

    public function __invoke($id)
    {
        $subcategory_info = Subcategory::findOrFail($id);

        return view('admin.editsubcategory', compact('subcategory_info'));

    }
}
