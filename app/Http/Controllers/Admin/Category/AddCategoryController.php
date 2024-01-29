<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddCategoryController extends Controller
{

    public function __invoke(Request $request)
    {
        return view('admin.addcategory');
    }
}
