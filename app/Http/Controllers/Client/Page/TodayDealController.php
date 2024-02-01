<?php

namespace App\Http\Controllers\Client\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodayDealController extends Controller
{

    public function __invoke(Request $request)
    {
        return view('user_template.todays_deal');
    }
}
