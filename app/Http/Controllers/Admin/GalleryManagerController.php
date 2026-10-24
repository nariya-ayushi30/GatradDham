<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryManagerController extends Controller
{
    /**
     * List all gallery items
     */
    public function index(Request $request)
    {
        $query = GalleryItem::latest();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $items = $query->paginate(15);

        return view('admin.gallery.index', compact('items'));
    }

    /**
     * Store new gallery photo (File upload or URL)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:150',
            'title_gu' => 'nullable|string|max:150',
            'category' => 'required|in:darshan,utsav,mandir,seva',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:500',
            'is_featured' => 'nullable|boolean',
        ]);

        $titleEn = $request->title_en ?: ($request->title_gu ?? null);
        $titleGu = $request->title_gu ?: ($request->title_en ?? null);

        if (empty($titleEn) && empty($titleGu)) {
            $msg = app()->getLocale() == 'gu' ? 'કૃપા કરીને ફોટો શીર્ષક દાખલ કરો.' : 'Please enter photo title.';
            return back()->withErrors(['title_en' => $msg])->withInput();
        }

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDir = public_path('uploads/gallery');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $imageUrl = '/uploads/gallery/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imageUrl = $validated['image_url'];
        } else {
            $msg = app()->getLocale() == 'gu' ? 'કૃપા કરીને ફોટો પસંદ કરો અથવા URL દાખલ કરો.' : 'Please select an image file or enter an image URL.';
            return back()->withErrors(['image' => $msg])->withInput();
        }

        GalleryItem::create([
            'title_en' => $titleEn,
            'title_gu' => $titleGu,
            'category' => $validated['category'],
            'image_url' => $imageUrl,
            'is_featured' => $request->has('is_featured'),
        ]);

        $successMsg = app()->getLocale() == 'gu' ? 'ગેલેરી ફોટો સફળતાપૂર્વક ઉમેરાયો.' : 'Gallery photo added successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Update existing gallery photo
     */
    public function update(Request $request, $id)
    {
        $item = GalleryItem::findOrFail($id);

        $request->validate([
            'title_en' => 'nullable|string|max:150',
            'title_gu' => 'nullable|string|max:150',
            'category' => 'required|in:darshan,utsav,mandir,seva',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:500',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($request->has('title_gu') || $request->has('title_en')) {
            $item->title_gu = $request->title_gu ?: ($request->title_en ?: $item->title_gu);
            $item->title_en = $request->title_en ?: ($request->title_gu ?: $item->title_en);
        }

        $item->category = $request->category;
        $item->is_featured = $request->has('is_featured');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDir = public_path('uploads/gallery');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $item->image_url = '/uploads/gallery/' . $filename;
        } elseif (!empty($request->image_url)) {
            $item->image_url = $request->image_url;
        }

        $item->save();

        $successMsg = app()->getLocale() == 'gu' ? 'ગેલેરી ફોટો સફળતાપૂર્વક અપડેટ થયો.' : 'Gallery photo updated successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Delete gallery item
     */
    public function destroy($id)
    {
        $item = GalleryItem::findOrFail($id);

        if ($item->image_url && str_starts_with($item->image_url, '/uploads/gallery/')) {
            $localPath = public_path($item->image_url);
            if (File::exists($localPath)) {
                File::delete($localPath);
            }
        }

        $item->delete();

        $successMsg = app()->getLocale() == 'gu' ? 'ગેલેરી ફોટો સફળતાપૂર્વક ડિલીટ કર્યો.' : 'Gallery photo deleted successfully.';
        return back()->with('success', $successMsg);
    }
}
