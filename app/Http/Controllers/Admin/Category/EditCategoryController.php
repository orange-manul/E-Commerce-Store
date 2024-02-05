<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class EditCategoryController extends BaseController
{

    public function __invoke($id): Factory|View|Application
    {
        $category_info =  $this->categoryService->edit($id);

        return view('admin.editcategory', compact('category_info'));

    }
}
