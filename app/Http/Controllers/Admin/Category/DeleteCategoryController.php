<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\BaseController;

class DeleteCategoryController extends BaseController
{

    public function __invoke($id)
    {
        $this->categoryService->delete($id);
        return redirect()->route('all.category')->with('message', "Category Delete Successfully");
    }
}
