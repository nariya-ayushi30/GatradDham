<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TrustActivity;
use Illuminate\Http\Request;

class TrustController extends Controller
{
    /**
     * Show Trust Activities & Seva projects
     */
    public function index()
    {
        $activities = TrustActivity::all();

        return view('frontend.trust', compact('activities'));
    }
}
