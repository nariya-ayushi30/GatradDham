<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TrustActivityManagerController extends Controller
{
    /**
     * List all trust charitable activities
     */
    public function index()
    {
        $activities = TrustActivity::latest()->paginate(15);
        return view('admin.trust.index', compact('activities'));
    }

    /**
     * Store new trust activity (English First with File Upload)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:150',
            'title_gu' => 'nullable|string|max:150',
            'subtitle_en' => 'nullable|string|max:200',
            'subtitle_gu' => 'nullable|string|max:200',
            'description_en' => 'nullable|string',
            'description_gu' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'stats_en' => 'nullable|string|max:100',
            'stats_gu' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:500',
        ]);

        $titleEn = !empty($validated['title_en']) ? $validated['title_en'] : (!empty($validated['title_gu']) ? $validated['title_gu'] : null);
        $titleGu = !empty($validated['title_gu']) ? $validated['title_gu'] : (!empty($validated['title_en']) ? $validated['title_en'] : null);

        if (empty($titleEn) && empty($titleGu)) {
            $msg = app()->getLocale() == 'gu' ? 'કૃપા કરીને પ્રવૃત્તિનું શીર્ષક દાખલ કરો.' : 'Please enter activity title.';
            return back()->withErrors(['title_en' => $msg])->withInput();
        }

        $descEn = !empty($validated['description_en']) ? $validated['description_en'] : (!empty($validated['description_gu']) ? $validated['description_gu'] : null);
        $descGu = !empty($validated['description_gu']) ? $validated['description_gu'] : (!empty($validated['description_en']) ? $validated['description_en'] : null);

        if (empty($descEn) && empty($descGu)) {
            $descEn = $titleEn;
            $descGu = $titleGu;
        }

        $subEn = !empty($validated['subtitle_en']) ? $validated['subtitle_en'] : (!empty($validated['subtitle_gu']) ? $validated['subtitle_gu'] : null);
        $subGu = !empty($validated['subtitle_gu']) ? $validated['subtitle_gu'] : (!empty($validated['subtitle_en']) ? $validated['subtitle_en'] : null);

        $statsEn = !empty($validated['stats_en']) ? $validated['stats_en'] : (!empty($validated['stats_gu']) ? $validated['stats_gu'] : null);
        $statsGu = !empty($validated['stats_gu']) ? $validated['stats_gu'] : (!empty($validated['stats_en']) ? $validated['stats_en'] : null);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDir = public_path('uploads/activities');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = 'activity_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $imageUrl = '/uploads/activities/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imageUrl = $validated['image_url'];
        } else {
            $imageUrl = 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=600&q=80';
        }

        TrustActivity::create([
            'title_en' => $titleEn,
            'title_gu' => $titleGu,
            'subtitle_en' => $subEn,
            'subtitle_gu' => $subGu,
            'description_en' => $descEn,
            'description_gu' => $descGu,
            'icon' => !empty($validated['icon']) ? $validated['icon'] : 'fa-hand-holding-heart',
            'stats_en' => $statsEn,
            'stats_gu' => $statsGu,
            'image_url' => $imageUrl,
        ]);

        $successMsg = app()->getLocale() == 'gu' ? 'ટ્રસ્ટ સેવા પ્રવૃત્તિ સફળતાપૂર્વક ઉમેરાઈ.' : 'Trust Seva activity added successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Update existing trust activity
     */
    public function update(Request $request, $id)
    {
        $activity = TrustActivity::findOrFail($id);

        $request->validate([
            'title_en' => 'nullable|string|max:150',
            'title_gu' => 'nullable|string|max:150',
            'subtitle_en' => 'nullable|string|max:200',
            'subtitle_gu' => 'nullable|string|max:200',
            'description_en' => 'nullable|string',
            'description_gu' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'stats_en' => 'nullable|string|max:100',
            'stats_gu' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:500',
        ]);

        if ($request->has('title_gu') || $request->has('title_en')) {
            $activity->title_gu = $request->title_gu ?: ($request->title_en ?: $activity->title_gu);
            $activity->title_en = $request->title_en ?: ($request->title_gu ?: $activity->title_en);
        }
        if ($request->has('subtitle_gu') || $request->has('subtitle_en')) {
            $activity->subtitle_gu = $request->subtitle_gu ?: ($request->subtitle_en ?: $activity->subtitle_gu);
            $activity->subtitle_en = $request->subtitle_en ?: ($request->subtitle_gu ?: $activity->subtitle_en);
        }
        if ($request->has('description_gu') || $request->has('description_en')) {
            $activity->description_gu = $request->description_gu ?: ($request->description_en ?: $activity->description_gu);
            $activity->description_en = $request->description_en ?: ($request->description_gu ?: $activity->description_en);
        }
        if ($request->has('stats_gu') || $request->has('stats_en')) {
            $activity->stats_gu = $request->stats_gu ?: ($request->stats_en ?: $activity->stats_gu);
            $activity->stats_en = $request->stats_en ?: ($request->stats_gu ?: $activity->stats_en);
        }
        if ($request->has('icon')) {
            $activity->icon = $request->icon ?: $activity->icon;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDir = public_path('uploads/activities');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = 'activity_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $activity->image_url = '/uploads/activities/' . $filename;
        } elseif (!empty($request->image_url)) {
            $activity->image_url = $request->image_url;
        }

        $activity->save();

        $successMsg = app()->getLocale() == 'gu' ? 'ટ્રસ્ટ સેવા પ્રવૃત્તિ સફળતાપૂર્વક અપડેટ થઈ.' : 'Trust activity updated successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Delete trust activity
     */
    public function destroy($id)
    {
        $activity = TrustActivity::findOrFail($id);

        if ($activity->image_url && str_starts_with($activity->image_url, '/uploads/activities/')) {
            $localPath = public_path($activity->image_url);
            if (File::exists($localPath)) {
                File::delete($localPath);
            }
        }

        $activity->delete();

        $successMsg = app()->getLocale() == 'gu' ? 'પ્રવૃત્તિ સફળતાપૂર્વક ડિલીટ કરી.' : 'Trust activity deleted successfully.';
        return back()->with('success', $successMsg);
    }
}
