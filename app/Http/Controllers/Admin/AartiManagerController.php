<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AartiTiming;
use Illuminate\Http\Request;

class AartiManagerController extends Controller
{
    /**
     * List all aarti timings
     */
    public function index()
    {
        $aartis = AartiTiming::orderBy('order')->get();

        return view('admin.aarti.index', compact('aartis'));
    }

    /**
     * Store new aarti timing (English First)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:100',
            'title_gu' => 'nullable|string|max:100',
            'time_en' => 'nullable|string|max:50',
            'time_gu' => 'nullable|string|max:50',
            'desc_en' => 'nullable|string|max:300',
            'desc_gu' => 'nullable|string|max:300',
            'badge_en' => 'nullable|string|max:50',
            'badge_gu' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        $titleEn = !empty($validated['title_en']) ? $validated['title_en'] : (!empty($validated['title_gu']) ? $validated['title_gu'] : null);
        $titleGu = !empty($validated['title_gu']) ? $validated['title_gu'] : (!empty($validated['title_en']) ? $validated['title_en'] : null);

        if (empty($titleEn) && empty($titleGu)) {
            $msg = app()->getLocale() == 'gu' ? 'કૃપા કરીને આરતીનું નામ દાખલ કરો.' : 'Please enter aarti name.';
            return back()->withErrors(['title_en' => $msg])->withInput();
        }

        $timeEn = !empty($validated['time_en']) ? $validated['time_en'] : (!empty($validated['time_gu']) ? $validated['time_gu'] : null);
        $timeGu = !empty($validated['time_gu']) ? $validated['time_gu'] : (!empty($validated['time_en']) ? $validated['time_en'] : null);

        if (empty($timeEn) && empty($timeGu)) {
            $msg = app()->getLocale() == 'gu' ? 'કૃપા કરીને આરતીનો સમય દાખલ કરો.' : 'Please enter aarti timing.';
            return back()->withErrors(['time_en' => $msg])->withInput();
        }

        $descEn = !empty($validated['desc_en']) ? $validated['desc_en'] : (!empty($validated['desc_gu']) ? $validated['desc_gu'] : null);
        $descGu = !empty($validated['desc_gu']) ? $validated['desc_gu'] : (!empty($validated['desc_en']) ? $validated['desc_en'] : null);

        $badgeEn = !empty($validated['badge_en']) ? $validated['badge_en'] : (!empty($validated['badge_gu']) ? $validated['badge_gu'] : null);
        $badgeGu = !empty($validated['badge_gu']) ? $validated['badge_gu'] : (!empty($validated['badge_en']) ? $validated['badge_en'] : null);

        AartiTiming::create([
            'title_en' => $titleEn,
            'title_gu' => $titleGu,
            'time_en' => $timeEn,
            'time_gu' => $timeGu,
            'desc_en' => $descEn,
            'desc_gu' => $descGu,
            'badge_en' => $badgeEn,
            'badge_gu' => $badgeGu,
            'order' => $validated['order'] ?? 0,
        ]);

        $successMsg = app()->getLocale() == 'gu' ? 'આરતી સમયપત્રક સફળતાપૂર્વક ઉમેરાયું.' : 'Aarti timing added successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Update existing aarti timing
     */
    public function update(Request $request, $id)
    {
        $aarti = AartiTiming::findOrFail($id);

        $request->validate([
            'title_en' => 'nullable|string|max:100',
            'title_gu' => 'nullable|string|max:100',
            'time_en' => 'nullable|string|max:50',
            'time_gu' => 'nullable|string|max:50',
            'desc_en' => 'nullable|string|max:300',
            'desc_gu' => 'nullable|string|max:300',
            'badge_en' => 'nullable|string|max:50',
            'badge_gu' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        if ($request->has('title_gu') || $request->has('title_en')) {
            $aarti->title_gu = $request->title_gu ?: ($request->title_en ?: $aarti->title_gu);
            $aarti->title_en = $request->title_en ?: ($request->title_gu ?: $aarti->title_en);
        }
        if ($request->has('time_gu') || $request->has('time_en')) {
            $aarti->time_gu = $request->time_gu ?: ($request->time_en ?: $aarti->time_gu);
            $aarti->time_en = $request->time_en ?: ($request->time_gu ?: $aarti->time_en);
        }
        if ($request->has('desc_gu') || $request->has('desc_en')) {
            $aarti->desc_gu = $request->desc_gu ?: ($request->desc_en ?: $aarti->desc_gu);
            $aarti->desc_en = $request->desc_en ?: ($request->desc_gu ?: $aarti->desc_en);
        }
        if ($request->has('badge_gu') || $request->has('badge_en')) {
            $aarti->badge_gu = $request->badge_gu ?: ($request->badge_en ?: $aarti->badge_gu);
            $aarti->badge_en = $request->badge_en ?: ($request->badge_gu ?: $aarti->badge_en);
        }
        if ($request->has('order')) {
            $aarti->order = (int) $request->order;
        }

        $aarti->save();

        $successMsg = app()->getLocale() == 'gu' ? 'આરતી સમયપત્રક સફળતાપૂર્વક અપડેટ થયું.' : 'Aarti timing updated successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Delete aarti timing
     */
    public function destroy($id)
    {
        $aarti = AartiTiming::findOrFail($id);
        $aarti->delete();

        $successMsg = app()->getLocale() == 'gu' ? 'આરતી સમયપત્રક સફળતાપૂર્વક ડિલીટ કર્યું.' : 'Aarti timing deleted successfully.';
        return back()->with('success', $successMsg);
    }
}
