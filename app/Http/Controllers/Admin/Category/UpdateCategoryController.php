<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Service\Admin\CategoryService;
use Illuminate\Http\RedirectResponse;

class UpdateCategoryController extends BaseController
{
    public function __invoke(UpdateCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $category_id = $request->category_id;

        $this->categoryService->update($category_id, $data);

        return redirect()->route('all.category')->with('message', 'Category Updated Successfully');
    }
}
