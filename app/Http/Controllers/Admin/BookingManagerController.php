<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomBooking;
use Illuminate\Http\Request;

class BookingManagerController extends Controller
{
    /**
     * Display all real database room booking requests
     */
    public function index(Request $request)
    {
        $query = RoomBooking::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Update room booking status
     */
    public function updateStatus(Request $request, $id)
    {
        $booking = RoomBooking::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Pending,Approved,Completed,Cancelled',
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'બુકિંગ સ્ટેટસ સફળતાપૂર્વક અપડેટ થયું.');
    }

    /**
     * Update room booking details
     */
    public function update(Request $request, $id)
    {
        $booking = RoomBooking::findOrFail($id);

        $validated = $request->validate([
            'guest_name'   => 'required|string|max:255',
            'phone'        => 'required|string|max:50',
            'city'         => 'nullable|string|max:255',
            'room_type'    => 'nullable|string|max:255',
            'rooms_count'  => 'nullable|integer|min:1',
            'guests_count' => 'nullable|integer|min:1',
            'check_in'     => 'nullable|date',
            'status'       => 'required|in:Pending,Approved,Completed,Cancelled',
            'notes'        => 'nullable|string',
        ]);

        $booking->update($validated);

        return back()->with('success', app()->getLocale() === 'gu' ? 'બુકિંગ વિગતો સફળતાપૂર્વક અપડેટ થઈ.' : 'Booking details updated successfully.');
    }

    /**
     * Delete booking request
     */
    public function destroy($id)
    {
        $booking = RoomBooking::findOrFail($id);
        $booking->delete();

        return back()->with('success', 'બુકિંગ રેકોર્ડ સફળતાપૂર્વક ડિલીટ કર્યો.');
    }
}
