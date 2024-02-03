<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Models\Category;
use App\Service\Admin\CategoryService;
use Illuminate\Http\Request;

class   StoreCategoryController extends Controller
{
    protected $categoryService;

    public function __invoke(StoreCategoryRequest $request, CategoryService $categoryService){

        $data = $request->validated();

        $category = $this->categoryService->store($data);

        return redirect()->route('all.category')->with('message', 'Category Added Successfully');
    }
}
