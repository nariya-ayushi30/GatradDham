<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutManagerController extends Controller
{
    /**
     * Show About Us page content editor
     */
    public function index()
    {
        $about = AboutPage::firstOrNew(['id' => 1]);
        return view('admin.about.index', compact('about'));
    }

    /**
     * Update About Us page content
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Banner
            'banner_badge_en' => 'nullable|string|max:100',
            'banner_badge_gu' => 'nullable|string|max:100',
            'banner_title_en' => 'nullable|string|max:200',
            'banner_title_gu' => 'nullable|string|max:200',
            'banner_subtitle_en' => 'nullable|string|max:500',
            'banner_subtitle_gu' => 'nullable|string|max:500',
            'hero_image' => 'nullable|string|max:500',
            'hero_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',

            // Section 1
            'sec1_title_en' => 'nullable|string|max:200',
            'sec1_title_gu' => 'nullable|string|max:200',
            'sec1_content_en' => 'nullable|string',
            'sec1_content_gu' => 'nullable|string',
            'sec1_image' => 'nullable|string|max:500',
            'sec1_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',

            // Stuti / Shloka
            'shlok_text' => 'nullable|string',
            'shlok_meaning_en' => 'nullable|string',
            'shlok_meaning_gu' => 'nullable|string',
            'shlok_badge_en' => 'nullable|string|max:100',
            'shlok_badge_gu' => 'nullable|string|max:100',

            // Section 2
            'sec2_title_en' => 'nullable|string|max:200',
            'sec2_title_gu' => 'nullable|string|max:200',
            'sec2_content_en' => 'nullable|string',
            'sec2_content_gu' => 'nullable|string',
            'sec2_image' => 'nullable|string|max:500',
            'sec2_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',

            // Features (1 to 4)
            'feature1_icon' => 'nullable|string|max:50',
            'feature1_title_en' => 'nullable|string|max:100',
            'feature1_title_gu' => 'nullable|string|max:100',
            'feature1_desc_en' => 'nullable|string|max:250',
            'feature1_desc_gu' => 'nullable|string|max:250',

            'feature2_icon' => 'nullable|string|max:50',
            'feature2_title_en' => 'nullable|string|max:100',
            'feature2_title_gu' => 'nullable|string|max:100',
            'feature2_desc_en' => 'nullable|string|max:250',
            'feature2_desc_gu' => 'nullable|string|max:250',

            'feature3_icon' => 'nullable|string|max:50',
            'feature3_title_en' => 'nullable|string|max:100',
            'feature3_title_gu' => 'nullable|string|max:100',
            'feature3_desc_en' => 'nullable|string|max:250',
            'feature3_desc_gu' => 'nullable|string|max:250',

            'feature4_icon' => 'nullable|string|max:50',
            'feature4_title_en' => 'nullable|string|max:100',
            'feature4_title_gu' => 'nullable|string|max:100',
            'feature4_desc_en' => 'nullable|string|max:250',
            'feature4_desc_gu' => 'nullable|string|max:250',

            // Stats (1 to 4)
            'stat1_val' => 'nullable|string|max:30',
            'stat1_label_en' => 'nullable|string|max:100',
            'stat1_label_gu' => 'nullable|string|max:100',

            'stat2_val' => 'nullable|string|max:30',
            'stat2_label_en' => 'nullable|string|max:100',
            'stat2_label_gu' => 'nullable|string|max:100',

            'stat3_val' => 'nullable|string|max:30',
            'stat3_label_en' => 'nullable|string|max:100',
            'stat3_label_gu' => 'nullable|string|max:100',

            'stat4_val' => 'nullable|string|max:30',
            'stat4_label_en' => 'nullable|string|max:100',
            'stat4_label_gu' => 'nullable|string|max:100',
        ]);

        $about = AboutPage::firstOrNew(['id' => 1]);

        $uploadDir = public_path('uploads/about');
        if (!File::isDirectory($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true, true);
        }

        // Handle Hero Image Upload
        if ($request->hasFile('hero_image_file')) {
            $file = $request->file('hero_image_file');
            $filename = 'hero_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $about->hero_image = '/uploads/about/' . $filename;
        } elseif ($request->filled('hero_image')) {
            $about->hero_image = $request->hero_image;
        }

        // Handle Sec1 Image Upload
        if ($request->hasFile('sec1_image_file')) {
            $file = $request->file('sec1_image_file');
            $filename = 'sec1_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $about->sec1_image = '/uploads/about/' . $filename;
        } elseif ($request->filled('sec1_image')) {
            $about->sec1_image = $request->sec1_image;
        }

        // Handle Sec2 Image Upload
        if ($request->hasFile('sec2_image_file')) {
            $file = $request->file('sec2_image_file');
            $filename = 'sec2_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $filename);
            $about->sec2_image = '/uploads/about/' . $filename;
        } elseif ($request->filled('sec2_image')) {
            $about->sec2_image = $request->sec2_image;
        }

        // Fill text and configuration fields
        $fields = [
            'banner_badge_en', 'banner_badge_gu',
            'banner_title_en', 'banner_title_gu',
            'banner_subtitle_en', 'banner_subtitle_gu',
            'sec1_title_en', 'sec1_title_gu',
            'sec1_content_en', 'sec1_content_gu',
            'shlok_text', 'shlok_meaning_en', 'shlok_meaning_gu', 'shlok_badge_en', 'shlok_badge_gu',
            'sec2_title_en', 'sec2_title_gu',
            'sec2_content_en', 'sec2_content_gu',
            'feature1_icon', 'feature1_title_en', 'feature1_title_gu', 'feature1_desc_en', 'feature1_desc_gu',
            'feature2_icon', 'feature2_title_en', 'feature2_title_gu', 'feature2_desc_en', 'feature2_desc_gu',
            'feature3_icon', 'feature3_title_en', 'feature3_title_gu', 'feature3_desc_en', 'feature3_desc_gu',
            'feature4_icon', 'feature4_title_en', 'feature4_title_gu', 'feature4_desc_en', 'feature4_desc_gu',
            'stat1_val', 'stat1_label_en', 'stat1_label_gu',
            'stat2_val', 'stat2_label_en', 'stat2_label_gu',
            'stat3_val', 'stat3_label_en', 'stat3_label_gu',
            'stat4_val', 'stat4_label_en', 'stat4_label_gu',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $about->{$field} = $request->input($field);
            }
        }

        // Mirror values if either language side is empty so frontend always renders cleanly
        $pairs = [
            ['banner_badge_en', 'banner_badge_gu'],
            ['banner_title_en', 'banner_title_gu'],
            ['banner_subtitle_en', 'banner_subtitle_gu'],
            ['sec1_title_en', 'sec1_title_gu'],
            ['sec1_content_en', 'sec1_content_gu'],
            ['shlok_meaning_en', 'shlok_meaning_gu'],
            ['shlok_badge_en', 'shlok_badge_gu'],
            ['sec2_title_en', 'sec2_title_gu'],
            ['sec2_content_en', 'sec2_content_gu'],
            ['feature1_title_en', 'feature1_title_gu'],
            ['feature1_desc_en', 'feature1_desc_gu'],
            ['feature2_title_en', 'feature2_title_gu'],
            ['feature2_desc_en', 'feature2_desc_gu'],
            ['feature3_title_en', 'feature3_title_gu'],
            ['feature3_desc_en', 'feature3_desc_gu'],
            ['feature4_title_en', 'feature4_title_gu'],
            ['feature4_desc_en', 'feature4_desc_gu'],
            ['stat1_label_en', 'stat1_label_gu'],
            ['stat2_label_en', 'stat2_label_gu'],
            ['stat3_label_en', 'stat3_label_gu'],
            ['stat4_label_en', 'stat4_label_gu'],
        ];

        foreach ($pairs as [$en, $gu]) {
            if (empty($about->{$en}) && !empty($about->{$gu})) {
                $about->{$en} = $about->{$gu};
            } elseif (empty($about->{$gu}) && !empty($about->{$en})) {
                $about->{$gu} = $about->{$en};
            }
        }

        $about->save();

        $msg = app()->getLocale() == 'gu' ? 'ઇતિહાસ & પરિચય પેજ સફળતાપૂર્વક અપડેટ થયું.' : 'About Us page content updated successfully.';
        return back()->with('success', $msg);
    }
}
