<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategory\UpdateSubCategoryRequest;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class UpdateSubcategoryController extends Controller
{
    public function __invoke(UpdateSubCategoryRequest $request)
    {
        $subcategory_id = $request->subcategory_id;

        Subcategory::findOrFail($subcategory_id)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace(' ', '-', $request->subcategory_name)),
        ]);

        return redirect()->route('all.subcategory')->with('message', 'Sub Category Update Successfully');

    }
}
