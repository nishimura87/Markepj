<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function about(Request $request)
    {
        return view('about');
    }

    public function privacy(Request $request)
    {
        return view('privacy');
    }

    public function law(Request $request)
    {
        return view('law');
    }
}
