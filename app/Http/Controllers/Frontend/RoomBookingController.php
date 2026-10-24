<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RoomBooking;
use Illuminate\Http\Request;

class RoomBookingController extends Controller
{
    /**
     * Show Dharamshala / Rooms booking inquiry form
     */
    public function index()
    {
        $isGu = app()->getLocale() === 'gu';

        $rooms = [
            [
                'type' => $isGu ? 'ડિલક્સ એસી રૂમ (Deluxe AC)' : 'Deluxe AC Room',
                'capacity' => $isGu ? '૨ થી ૪ વ્યક્તિ' : '2 to 4 Persons',
                'features' => $isGu 
                    ? ['સ્વચ્છ એર કન્ડિશનર', 'અટેચ્ડ બાથરૂમ & ગીઝર', 'ડબલ બેડ', 'વોર્ડરોબ']
                    : ['Air Conditioning & Geyser', 'Attached Clean Bathroom', 'Comfortable Double Bed', 'Wardrobe & Luggage Rack'],
                'tag' => $isGu ? 'સૌથી લોકપ્રિય' : 'Most Popular'
            ],
            [
                'type' => $isGu ? 'સ્ટાન્ડર્ડ નોન-એસી રૂમ (Standard Non-AC)' : 'Standard Non-AC Room',
                'capacity' => $isGu ? '૨ થી ૩ વ્યક્તિ' : '2 to 3 Persons',
                'features' => $isGu 
                    ? ['હવા-ઉજાસ યુક્ત રૂમ', 'અટેચ્ડ બાથરૂમ', 'ગરમ પાણી સુવિધા', 'ટ્વીન બેડ']
                    : ['Well-ventilated & Airy Room', 'Attached Bathroom', 'Hot Water Availability', 'Twin Single Beds'],
                'tag' => $isGu ? 'બજેટ અનુકૂળ' : 'Budget Friendly'
            ],
            [
                'type' => $isGu ? 'સંઘ હોલ / ડોર્મિટરી (Group Hall)' : 'Group Sangha Hall / Dormitory',
                'capacity' => $isGu ? '૧૫ થી ૩૦ વ્યક્તિ' : '15 to 30 Persons',
                'features' => $isGu 
                    ? ['મોટા પરિવાર કે યાત્રા સંઘ માટે', 'સ્વતંત્ર ટોઇલેટ બ્લોક', 'ગાદલા-ચાદર વ્યવસ્થા']
                    : ['Ideal for Pilgrim Groups / Families', 'Multiple Restroom Blocks', 'Mattresses & Bedding Provided'],
                'tag' => $isGu ? 'સંઘ સુવિધા' : 'Group Facility'
            ]
        ];

        return view('frontend.rooms', compact('rooms'));
    }

    /**
     * Store booking request directly to MySQL database
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'guest_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'city' => 'required|string|max:100',
            'room_type' => 'required|string',
            'check_in' => 'required|date',
            'guests_count' => 'required|integer|min:1|max:50',
            'notes' => 'nullable|string|max:500',
        ]);

        $bookingCode = 'BK-' . date('ymd') . '-' . rand(100, 999);

        RoomBooking::create([
            'booking_code' => $bookingCode,
            'guest_name' => $validated['guest_name'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'room_type' => $validated['room_type'],
            'rooms_count' => ceil($validated['guests_count'] / 3),
            'guests_count' => $validated['guests_count'],
            'check_in' => $validated['check_in'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'Pending',
        ]);

        return back()->with('booking_success', 'ધન્યવાદ! આપની રૂમ બુકિંગ પૂછપરછ (કોડ: ' . $bookingCode . ') નોંધાઈ ગઈ છે. મંદિર કાર્યાલય દ્વારા ૨૪ કલાકમાં ફોન પર સંપર્ક કરવામાં આવશે.');
    }
}
