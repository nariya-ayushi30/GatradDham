<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Show Photo & Video Darshan Gallery
     */
    public function index(Request $request)
    {
        $category = $request->query('category');

        $query = GalleryItem::latest();

        if ($category && in_array($category, ['darshan', 'utsav', 'mandir', 'seva'])) {
            $query->where('category', $category);
        }

        $items = $query->paginate(12);

        return view('frontend.gallery', compact('items', 'category'));
    }
}
