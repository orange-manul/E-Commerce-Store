<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;
use App\Service\Admin\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateCategoryController extends Controller
{
    public function __invoke(UpdateCategoryRequest $request, CategoryService $categoryService): RedirectResponse
    {
        $data = $request->validated();
        $category_id = $request->category_id;

        $categoryService->update($category_id, $data);

        return redirect()->route('all.category')->with('message', 'Category Updated Successfully');
    }
}
