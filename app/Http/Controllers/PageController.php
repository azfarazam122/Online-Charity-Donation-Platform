<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View; // Import View

class PageController extends Controller
{
    /**
     * Display the Terms of Service page.
     *
     * @return \Illuminate\View\View
     */
    public function terms(): View
    {
        return view('pages.terms');
    }

    /**
     * Display the Privacy Policy page.
     *
     * @return \Illuminate\View\View
     */
    public function privacy(): View
    {
        return view('pages.privacy');
    }
}
