<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LiveDarshan;
use App\Models\GalleryItem;
use App\Models\AartiTiming;
use Illuminate\Http\Request;

class LiveDarshanController extends Controller
{
    /**
     * Show Live Darshan streaming player, daily shringar and aarti timings
     */
    public function index()
    {
        $live = LiveDarshan::first();
        $recentDarshanPhotos = GalleryItem::where('category', 'darshan')->latest()->take(6)->get();
        $aartis = AartiTiming::orderBy('order')->get();

        return view('frontend.live-darshan', compact('live', 'recentDarshanPhotos', 'aartis'));
    }
}
