<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;

class   StoreCategoryController extends BaseController
{

    public function __invoke(StoreCategoryRequest $request): \Illuminate\Http\RedirectResponse
    {

        $data = $request->validated();
        $this->categoryService->store($data);

        return redirect()->route('all.category')->with('message', 'Category Added Successfully');
    }
}
