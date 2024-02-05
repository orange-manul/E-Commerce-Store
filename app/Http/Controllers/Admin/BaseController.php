<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Admin\CategoryService;
use App\Service\Admin\OrderService;
use App\Service\Admin\ProductService;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected CategoryService $categoryService;
    protected OrderService $orderService;
    protected ProductService $productService;

    public function __construct
    (
        CategoryService $categoryService,
        OrderService $orderService,
        ProductService $productService
    )
    {
        $this->categoryService = $categoryService;
        $this->orderService = $orderService;
        $this->productService = $productService;
    }
}
