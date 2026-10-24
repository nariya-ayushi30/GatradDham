<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderManagerController extends Controller
{
    /**
     * List all sliders
     */
    public function index()
    {
        $sliders = Slider::orderBy('order', 'asc')->latest()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Store new slider (File upload or Image URL)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:190',
            'title_gu' => 'nullable|string|max:190',
            'subtitle_en' => 'nullable|string|max:255',
            'subtitle_gu' => 'nullable|string|max:255',
            'button_text_en' => 'nullable|string|max:60',
            'button_text_gu' => 'nullable|string|max:60',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:8192',
            'image_url' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $titleEn = $request->title_en ?: ($request->title_gu ?? null);
        $titleGu = $request->title_gu ?: ($request->title_en ?? null);
        $subEn = $request->subtitle_en ?: ($request->subtitle_gu ?? null);
        $subGu = $request->subtitle_gu ?: ($request->subtitle_en ?? null);
        $btnEn = $request->button_text_en ?: ($request->button_text_gu ?? null);
        $btnGu = $request->button_text_gu ?: ($request->button_text_en ?? null);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDir = public_path('uploads/sliders');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = 'slider_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $imageUrl = '/uploads/sliders/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imageUrl = $validated['image_url'];
        } else {
            $msg = app()->getLocale() == 'gu' ? 'કૃપા કરીને સ્લાઇડર ફોટો અપલોડ કરો અથવા ઇમેજ URL દાખલ કરો.' : 'Please upload a slider image or enter an image URL.';
            return back()->withErrors(['image' => $msg])->withInput();
        }

        Slider::create([
            'title_en' => $titleEn,
            'title_gu' => $titleGu,
            'subtitle_en' => $subEn,
            'subtitle_gu' => $subGu,
            'button_text_en' => $btnEn,
            'button_text_gu' => $btnGu,
            'button_link' => $request->button_link,
            'image' => $imageUrl,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active') ? (bool) $request->is_active : true,
        ]);

        $msg = app()->getLocale() == 'gu' ? 'નવો સ્લાઇડર સફળતાપૂર્વક ઉમેરાઈ ગયો છે!' : 'New hero slider added successfully!';
        return redirect()->route('admin.sliders.index')->with('success', $msg);
    }

    /**
     * Update existing slider
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'title_en' => 'nullable|string|max:190',
            'title_gu' => 'nullable|string|max:190',
            'subtitle_en' => 'nullable|string|max:255',
            'subtitle_gu' => 'nullable|string|max:255',
            'button_text_en' => 'nullable|string|max:60',
            'button_text_gu' => 'nullable|string|max:60',
            'button_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:8192',
            'image_url' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->has('title_gu') || $request->has('title_en')) {
            $slider->title_gu = $request->title_gu ?: ($request->title_en ?: $slider->title_gu);
            $slider->title_en = $request->title_en ?: ($request->title_gu ?: $slider->title_en);
        }
        if ($request->has('subtitle_gu') || $request->has('subtitle_en')) {
            $slider->subtitle_gu = $request->subtitle_gu ?: ($request->subtitle_en ?: $slider->subtitle_gu);
            $slider->subtitle_en = $request->subtitle_en ?: ($request->subtitle_gu ?: $slider->subtitle_en);
        }
        if ($request->has('button_text_gu') || $request->has('button_text_en')) {
            $slider->button_text_gu = $request->button_text_gu ?: ($request->button_text_en ?: $slider->button_text_gu);
            $slider->button_text_en = $request->button_text_en ?: ($request->button_text_gu ?: $slider->button_text_en);
        }
        if ($request->has('button_link')) {
            $slider->button_link = $request->button_link;
        }
        if ($request->has('order')) {
            $slider->order = (int) $request->order;
        }
        if ($request->has('is_active')) {
            $slider->is_active = (bool) $request->is_active;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDir = public_path('uploads/sliders');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = 'slider_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $slider->image = '/uploads/sliders/' . $filename;
        } elseif (!empty($request->image_url)) {
            $slider->image = $request->image_url;
        }

        $slider->save();

        $msg = app()->getLocale() == 'gu' ? 'સ્લાઇડર સફળતાપૂર્વક અપડેટ કરવામાં આવ્યો છે!' : 'Slider updated successfully!';
        return redirect()->route('admin.sliders.index')->with('success', $msg);
    }

    /**
     * Delete slider
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image && !filter_var($slider->image, FILTER_VALIDATE_URL)) {
            $filePath = public_path(ltrim($slider->image, '/'));
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        $slider->delete();

        $msg = app()->getLocale() == 'gu' ? 'સ્લાઇડર સફળતાપૂર્વક ડિલીટ કરવામાં આવ્યો છે!' : 'Slider deleted successfully!';
        return redirect()->route('admin.sliders.index')->with('success', $msg);
    }
}
