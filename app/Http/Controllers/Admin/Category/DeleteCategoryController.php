<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DeleteCategoryController extends Controller
{

    public function __invoke($id)
    {
        Category::findOrFail($id)->delete();

        return redirect()->route('all.category')->with('message', "Category Delete Successfully");
    }
}
