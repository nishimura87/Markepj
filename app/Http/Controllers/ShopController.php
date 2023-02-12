<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home(Request $request)
    {
        return view('home');
    }

    public function about(Request $request)
    {
        return view('about');
    }
}
