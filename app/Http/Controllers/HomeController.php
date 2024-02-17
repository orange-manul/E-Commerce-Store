<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Service\Home\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(ProductService $service){
        $all_products = $service->index();
        return view('user_template.home', compact('all_products'));
    }
}
