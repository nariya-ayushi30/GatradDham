<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommitteeMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CommitteeManagerController extends Controller
{
    /**
     * List all committee members
     */
    public function index(Request $request)
    {
        $query = CommitteeMember::orderBy('committee_type')->orderBy('order');

        if ($request->filled('type')) {
            $query->where('committee_type', $request->type);
        }

        $members = $query->paginate(15);

        return view('admin.committees.index', compact('members'));
    }

    /**
     * Store new committee member (Full Bilingual Support)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'nullable|string|max:100',
            'name_gu' => 'nullable|string|max:100',
            'designation_en' => 'nullable|string|max:100',
            'designation_gu' => 'nullable|string|max:100',
            'committee_type' => 'required|in:trust,gam',
            'village_en' => 'nullable|string|max:100',
            'village_gu' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'photo_url' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
        ]);

        $nameEn = !empty($validated['name_en']) ? $validated['name_en'] : (!empty($validated['name_gu']) ? $validated['name_gu'] : null);
        $nameGu = !empty($validated['name_gu']) ? $validated['name_gu'] : (!empty($validated['name_en']) ? $validated['name_en'] : null);

        $nameField = app()->getLocale() == 'gu' ? 'name_gu' : 'name_en';
        $desigField = app()->getLocale() == 'gu' ? 'designation_gu' : 'designation_en';

        if (empty($nameEn) && empty($nameGu)) {
            $errorMsg = app()->getLocale() == 'gu' ? 'કૃપા કરીને સભ્યનું નામ દાખલ કરો.' : 'Please enter member name.';
            return back()->withErrors([$nameField => $errorMsg])->withInput();
        }

        $desigEn = !empty($validated['designation_en']) ? $validated['designation_en'] : (!empty($validated['designation_gu']) ? $validated['designation_gu'] : null);
        $desigGu = !empty($validated['designation_gu']) ? $validated['designation_gu'] : (!empty($validated['designation_en']) ? $validated['designation_en'] : null);

        if (empty($desigEn) && empty($desigGu)) {
            $errorMsg = app()->getLocale() == 'gu' ? 'કૃપા કરીને હોદ્દો દાખલ કરો.' : 'Please enter designation.';
            return back()->withErrors([$desigField => $errorMsg])->withInput();
        }

        $photoUrl = null;

        // Handle direct file upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $uploadDir = public_path('uploads/committees');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move($uploadDir, $filename);
            $photoUrl = '/uploads/committees/' . $filename;
        } elseif (!empty($validated['photo_url'])) {
            if (!str_contains($validated['photo_url'], 'admin/committees')) {
                $photoUrl = $validated['photo_url'];
            }
        }

        $villageEn = !empty($validated['village_en']) ? $validated['village_en'] : (!empty($validated['village_gu']) ? $validated['village_gu'] : null);
        $villageGu = !empty($validated['village_gu']) ? $validated['village_gu'] : (!empty($validated['village_en']) ? $validated['village_en'] : null);

        CommitteeMember::create([
            'name_en' => $nameEn,
            'name_gu' => $nameGu,
            'designation_en' => $desigEn,
            'designation_gu' => $desigGu,
            'committee_type' => $validated['committee_type'],
            'village_en' => $villageEn,
            'village_gu' => $villageGu,
            'phone' => $validated['phone'] ?? null,
            'photo_url' => $photoUrl,
            'order' => $validated['order'] ?? 0,
        ]);

        $successMsg = app()->getLocale() == 'gu' ? 'સમિતિ સભ્ય સફળતાપૂર્વક ઉમેરાયા.' : 'Committee member added successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Update existing committee member
     */
    public function update(Request $request, $id)
    {
        $member = CommitteeMember::findOrFail($id);

        $request->validate([
            'name_en' => 'nullable|string|max:100',
            'name_gu' => 'nullable|string|max:100',
            'designation_en' => 'nullable|string|max:100',
            'designation_gu' => 'nullable|string|max:100',
            'committee_type' => 'required|in:trust,gam',
            'village_en' => 'nullable|string|max:100',
            'village_gu' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'photo_url' => 'nullable|string|max:500',
            'order' => 'nullable|integer',
        ]);

        if ($request->has('name_gu') || $request->has('name_en')) {
            $member->name_gu = $request->name_gu ?: ($request->name_en ?: $member->name_gu);
            $member->name_en = $request->name_en ?: ($request->name_gu ?: $member->name_en);
        }
        if ($request->has('designation_gu') || $request->has('designation_en')) {
            $member->designation_gu = $request->designation_gu ?: ($request->designation_en ?: $member->designation_gu);
            $member->designation_en = $request->designation_en ?: ($request->designation_gu ?: $member->designation_en);
        }
        if ($request->has('village_gu') || $request->has('village_en')) {
            $member->village_gu = $request->village_gu ?: ($request->village_en ?: $member->village_gu);
            $member->village_en = $request->village_en ?: ($request->village_gu ?: $member->village_en);
        }

        $member->committee_type = $request->committee_type;
        $member->phone = $request->phone;
        if ($request->has('order')) {
            $member->order = (int) $request->order;
        }

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $uploadDir = public_path('uploads/committees');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo->move($uploadDir, $filename);
            $member->photo_url = '/uploads/committees/' . $filename;
        } elseif (!empty($request->photo_url)) {
            $member->photo_url = $request->photo_url;
        }

        $member->save();

        $successMsg = app()->getLocale() == 'gu' ? 'સમિતિ સભ્ય સફળતાપૂર્વક અપડેટ થયા.' : 'Committee member updated successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Delete committee member
     */
    public function destroy($id)
    {
        $member = CommitteeMember::findOrFail($id);
        
        if ($member->photo_url && str_starts_with($member->photo_url, '/uploads/committees/')) {
            $localPath = public_path($member->photo_url);
            if (File::exists($localPath)) {
                File::delete($localPath);
            }
        }

        $member->delete();

        $successMsg = app()->getLocale() == 'gu' ? 'સમિતિ સભ્ય સફળતાપૂર્વક ડિલીટ કર્યા.' : 'Committee member deleted successfully.';
        return back()->with('success', $successMsg);
    }
}
