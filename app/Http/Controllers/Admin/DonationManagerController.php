<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationManagerController extends Controller
{
    /**
     * Display all real database donations list
     */
    public function index(Request $request)
    {
        $query = Donation::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('receipt_no', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $donations = $query->paginate(15);

        return view('admin.donations.index', compact('donations'));
    }

    /**
     * Update a donation record
     */
    public function update(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $validated = $request->validate([
            'donor_name'   => 'required|string|max:255',
            'phone'        => 'nullable|string|max:50',
            'pan'          => 'nullable|string|max:50',
            'amount'       => 'required|numeric|min:1',
            'cause'        => 'nullable|string|max:255',
            'payment_mode' => 'nullable|string|max:50',
            'status'       => 'required|string|max:50',
        ]);

        $donation->update($validated);

        return back()->with('success', app()->getLocale() === 'gu' ? 'દાન વિગતો સફળતાપૂર્વક અપડેટ થઈ.' : 'Donation details updated successfully.');
    }

    /**
     * Delete a donation record
     */
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->delete();

        return back()->with('success', 'દાન રેકોર્ડ સફળતાપૂર્વક ડિલીટ કર્યો.');
    }
}
