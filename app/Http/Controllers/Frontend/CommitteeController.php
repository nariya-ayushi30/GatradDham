<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommitteeMember;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    /**
     * Show Mandir Trust Committee (ટ્રસ્ટ સમિતિ)
     */
    public function trust()
    {
        $members = CommitteeMember::where('committee_type', 'trust')
            ->orderBy('order')
            ->get();

        $pageType = 'trust';

        return view('frontend.committee', compact('members', 'pageType'));
    }

    /**
     * Show Gam / Samaj Committee (ગામ / સમાજ સમિતિ)
     */
    public function gam()
    {
        $members = CommitteeMember::where('committee_type', 'gam')
            ->orderBy('order')
            ->get();

        $pageType = 'gam';

        return view('frontend.committee', compact('members', 'pageType'));
    }
}
