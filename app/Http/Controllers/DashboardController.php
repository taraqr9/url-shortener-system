<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $urls = null;
        if(auth()->user()) {
            $urls = auth()->user()->url;
        }

        return view('dashboard', compact('urls'));
    }
}
