<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexCategoryController extends BaseController
{

    public function __invoke(Request $request): Factory|View|Application
    {
            $categories = $this->categoryService->index();
            return view('admin.allcategory', compact('categories'));
        }
    }

