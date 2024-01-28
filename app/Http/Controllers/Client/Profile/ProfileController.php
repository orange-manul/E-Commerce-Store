<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function __invoke(): View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('user_template.user_profile');
    }
}
