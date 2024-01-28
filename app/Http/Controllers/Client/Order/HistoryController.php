<?php

namespace App\Http\Controllers\Client\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function __invoke()
    {
        return view('user_template.history');
    }
}
