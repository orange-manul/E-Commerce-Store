<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexCategoryController extends Controller
{

    public function __invoke(Request $request)
        {
            $categories = Category::latest()->get();
            return view('admin.allcategory', compact('categories'));
        }
    }
