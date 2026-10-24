<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveDarshan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LiveDarshanManagerController extends Controller
{
    /**
     * Show live darshan settings
     */
    public function index()
    {
        $live = LiveDarshan::first();

        // Preset authentic temple shringar photos for 1-click select
        $presetShringars = [
            [
                'url' => '/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg',
                'title_gu' => 'સુવર્ણ અલંકાર દર્શન',
                'title_en' => 'Gold Alankar Darshan',
            ],
            [
                'url' => '/uploads/gallery/shringar/shringar_maa_gatrad_mukharvind.jpeg',
                'title_gu' => 'દિવ્ય મુખારવિંદ શૃંગાર',
                'title_en' => 'Divine Mukharvind Shringar',
            ],
            [
                'url' => '/uploads/gallery/shringar/shringar_maa_gatrad_nij_mandir.jpeg',
                'title_gu' => 'નિજ મંદિર ગર્ભગૃહ શૃંગાર',
                'title_en' => 'Nij Mandir Garbhagriha',
            ],
            [
                'url' => '/uploads/gallery/shringar/shringar_red_vastra_talwar.jpg',
                'title_gu' => 'લાલ વાઘા & આયુધ દર્શન',
                'title_en' => 'Red Vastra & Weapons',
            ],
            [
                'url' => '/uploads/gallery/shringar/shringar_green_vastra.jpg',
                'title_gu' => 'લીલા વાઘા વિશેષ શૃંગાર',
                'title_en' => 'Green Vastra Darshan',
            ],
            [
                'url' => '/uploads/gallery/shringar/shringar_puspa_mukut.jpg',
                'title_gu' => 'પુષ્પ મુકુટ દિવ્ય શૃંગાર',
                'title_en' => 'Floral Crown Shringar',
            ],
        ];

        return view('admin.live-darshan.index', compact('live', 'presetShringars'));
    }

    /**
     * Update live darshan stream info & shringar photo
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:200',
            'title_gu' => 'nullable|string|max:200',
            'youtube_embed_id' => 'nullable|string|max:500',
            'shringar_photo' => 'nullable|file|mimes:jpeg,png,jpg,webp,gif,bmp,jfif,heic|max:20480',
            'today_shringar_image' => 'nullable|string|max:1000',
            'notice_en' => 'nullable|string|max:1000',
            'notice_gu' => 'nullable|string|max:1000',
            'is_live' => 'nullable|boolean',
        ]);

        $live = LiveDarshan::firstOrNew(['id' => 1]);

        $titleEn = !empty($validated['title_en']) ? $validated['title_en'] : (!empty($validated['title_gu']) ? $validated['title_gu'] : ($live->title_en ?: 'Shree Gatrad Maa Live Aarti & Darshan'));
        $titleGu = !empty($validated['title_gu']) ? $validated['title_gu'] : (!empty($validated['title_en']) ? $validated['title_en'] : ($live->title_gu ?: 'શ્રી ગાત્રાળ માં અખંડ લાઈવ આરતી & દર્શન'));

        $shringarUrl = $live->today_shringar_image;

        // 1. If uploaded as a file
        if ($request->hasFile('shringar_photo')) {
            $photo = $request->file('shringar_photo');
            $uploadDir = public_path('uploads/shringar');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $ext = strtolower($photo->getClientOriginalExtension()) ?: 'jpg';
            $filename = 'shringar_' . time() . '_' . uniqid() . '.' . $ext;
            $photo->move($uploadDir, $filename);
            $shringarUrl = '/uploads/shringar/' . $filename;
        }
        // 2. If entered as URL or selected from preset gallery
        elseif (!empty($validated['today_shringar_image'])) {
            $imageUrl = trim($validated['today_shringar_image']);
            
            // If it is a web URL, download and save locally so it's permanent and never breaks
            if (str_starts_with($imageUrl, 'http://') || str_starts_with($imageUrl, 'https://')) {
                try {
                    $context = stream_context_create([
                        'http' => [
                            'timeout' => 8,
                            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
                        ],
                        'ssl' => [
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                        ]
                    ]);
                    $contents = @file_get_contents($imageUrl, false, $context);
                    if ($contents && strlen($contents) > 200) {
                        $uploadDir = public_path('uploads/shringar');
                        if (!File::isDirectory($uploadDir)) {
                            File::makeDirectory($uploadDir, 0755, true, true);
                        }
                        $ext = 'jpg';
                        if (str_contains(strtolower($imageUrl), '.png')) $ext = 'png';
                        elseif (str_contains(strtolower($imageUrl), '.webp')) $ext = 'webp';
                        elseif (str_contains(strtolower($imageUrl), '.jpeg')) $ext = 'jpeg';
                        
                        $filename = 'shringar_web_' . time() . '.' . $ext;
                        file_put_contents($uploadDir . DIRECTORY_SEPARATOR . $filename, $contents);
                        $shringarUrl = '/uploads/shringar/' . $filename;
                    } else {
                        $shringarUrl = $imageUrl;
                    }
                } catch (\Exception $e) {
                    $shringarUrl = $imageUrl;
                }
            } else {
                $shringarUrl = $imageUrl;
            }
        }

        $noticeEn = !empty($validated['notice_en']) ? $validated['notice_en'] : (!empty($validated['notice_gu']) ? $validated['notice_gu'] : $live->notice_en);
        $noticeGu = !empty($validated['notice_gu']) ? $validated['notice_gu'] : (!empty($validated['notice_en']) ? $validated['notice_en'] : $live->notice_gu);

        $youtubeId = null;
        if (!empty($validated['youtube_embed_id'])) {
            $rawId = trim($validated['youtube_embed_id']);
            if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|live\/|shorts\/))([\w-]{11})/', $rawId, $m)) {
                $youtubeId = $m[1];
            } elseif (preg_match('/^[\w-]{11}$/', $rawId)) {
                $youtubeId = $rawId;
            } else {
                $youtubeId = $rawId;
            }
        }

        $live->fill([
            'title_en' => $titleEn,
            'title_gu' => $titleGu,
            'youtube_embed_id' => $youtubeId,
            'today_shringar_image' => $shringarUrl,
            'notice_en' => $noticeEn,
            'notice_gu' => $noticeGu,
            'is_live' => $request->has('is_live'),
        ]);
        $live->save();

        $successMsg = app()->getLocale() == 'gu' ? 'લાઈવ દર્શન & શૃંગાર સેટિંગ્સ સફળતાપૂર્વક સેવ થઈ ગયા.' : 'Live Darshan & Daily Shringar settings saved successfully.';
        return back()->with('success', $successMsg);
    }
}
