<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactInquiryManagerController extends Controller
{
    /**
     * List all devotee inquiries / messages
     */
    public function index()
    {
        $inquiries = ContactInquiry::latest()->paginate(20);
        return view('admin.contacts.index', compact('inquiries'));
    }

    /**
     * Delete contact message
     */
    public function destroy($id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        $inquiry->delete();

        return back()->with('success', 'સંપર્ક સંદેશ સફળતાપૂર્વક દૂર કર્યો / Contact Message Removed Successfully.');
    }
}
