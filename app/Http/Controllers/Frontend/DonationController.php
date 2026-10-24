<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\TrustActivity;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Show E-Donation page with Bank info & UPI QR
     */
    public function index()
    {
        // Dynamic causes based on trust activities and general causes
        $activities = TrustActivity::all();
        
        $causes = $activities->map(function ($act) {
            return [
                'id' => $act->id,
                'title' => $act->title,
            ];
        });

        // Add additional traditional causes if fewer than 4
        if ($causes->isEmpty()) {
            $causes = collect([
                ['id' => 1, 'title' => 'અન્નક્ષેત્ર - ૧ દિવસ મહાપ્રસાદ સેવા'],
                ['id' => 2, 'title' => 'ગૌશાળા - ઘાસચારો & ગૌસેવા'],
                ['id' => 3, 'title' => 'શુભ દિવસે ધ્વજારોહણ સેવા'],
                ['id' => 4, 'title' => 'મંદિર પરિસર વિકાસ & જિર્ણોદ્ધાર'],
            ]);
        }

        return view('frontend.donation', compact('causes'));
    }

    /**
     * Process online donation and store to real MySQL database
     */
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'donor_name' => 'required|string|max:100',
            'donor_phone' => 'required|string|max:20',
            'donor_pan' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:1',
            'cause' => 'required|string',
        ]);

        $receiptNo = 'GD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        $donation = Donation::create([
            'receipt_no' => $receiptNo,
            'donor_name' => $validated['donor_name'],
            'phone' => $validated['donor_phone'],
            'pan' => $validated['donor_pan'] ? strtoupper($validated['donor_pan']) : null,
            'amount' => $validated['amount'],
            'cause' => $validated['cause'],
            'payment_mode' => 'UPI / Online',
            'status' => 'Verified'
        ]);

        return back()->with('receipt', [
            'receipt_no' => $donation->receipt_no,
            'date' => $donation->created_at->format('d/m/Y'),
            'donor_name' => $donation->donor_name,
            'amount' => $donation->amount,
            'cause' => $donation->cause,
            'status' => 'સફળતાપૂર્વક નોંધણી થયેલ છે',
        ]);
    }
}
