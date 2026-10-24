<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show contact and route information
     */
    public function index()
    {
        return view('frontend.contact');
    }

    /**
     * Submit contact / inquiry message directly to database
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:1000',
        ]);

        ContactInquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'] ?? 'સામાન્ય પૂછપરછ',
            'message' => $validated['message'],
        ]);

        return back()->with('contact_success', 'આપનો સંદેશ સફળતાપૂર્વક મળ્યો છે. મંદિર ટ્રસ્ટ વતી ટૂંક સમયમાં આપનો સંપર્ક કરવામાં આવશે.');
    }
}
