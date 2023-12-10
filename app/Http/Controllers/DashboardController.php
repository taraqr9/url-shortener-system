<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $urls = null;

        if (auth()->user()) {
            $urls = auth()->user()->urls()->orderByDesc('created_at')->paginate(15);
        }

        return view('dashboard', compact('urls'));
    }
}
