<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AartiTiming;
use App\Models\TrustActivity;
use App\Models\LiveDarshan;
use App\Models\GalleryItem;
use App\Models\BlogPost;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show main public landing page with dynamic database records
     */
    public function index()
    {
        $aartis = AartiTiming::orderBy('order')->get();
        $services = TrustActivity::all();
        $live = LiveDarshan::first();
        $featuredGallery = GalleryItem::where('is_featured', true)->take(6)->get();
        $latestBlogs = BlogPost::latest('published_date')->take(3)->get();
        $sliders = Slider::where('is_active', true)->orderBy('order')->latest()->get()->values();

        return view('frontend.home', compact('aartis', 'services', 'live', 'featuredGallery', 'latestBlogs', 'sliders'));
    }
}
