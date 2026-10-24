<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Show history, mahima & about the trust (Fully Dynamic from DB)
     */
    public function index()
    {
        $about = AboutPage::firstOrNew(['id' => 1]);
        return view('frontend.about', compact('about'));
    }
}
