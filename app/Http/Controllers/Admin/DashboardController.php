<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\RoomBooking;
use App\Models\CommitteeMember;
use App\Models\GalleryItem;
use App\Models\BlogPost;
use App\Models\ContactInquiry;
use App\Models\TrustActivity;
use App\Models\AartiTiming;
use App\Models\LiveDarshan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show Modern Admin Dashboard with dynamic database statistics and analytics
     */
    public function index()
    {
        // 1. Core Financial & Transaction Stats
        $totalDonationAmount = Donation::sum('amount') ?? 0;
        $todayDonationAmount = Donation::whereDate('created_at', Carbon::today())->sum('amount') ?? 0;
        $thisMonthDonationAmount = Donation::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount') ?? 0;
        $donationsCount = Donation::count();

        // 2. Room Booking Stats
        $activeBookingsCount = RoomBooking::where('status', 'Approved')->count();
        $pendingBookingsCount = RoomBooking::where('status', 'Pending')->count();
        $totalBookingsCount = RoomBooking::count();

        // 3. CMS & Committee Stats
        $trustCommitteeCount = CommitteeMember::where('committee_type', 'trust')->count();
        $gamCommitteeCount = CommitteeMember::where('committee_type', 'gam')->count();
        $galleryCount = GalleryItem::count();
        $trustActivitiesCount = TrustActivity::count();
        $blogsCount = BlogPost::count();
        $aartiCount = AartiTiming::count();
        $inquiriesCount = ContactInquiry::count();
        $pendingInquiriesCount = ContactInquiry::whereDate('created_at', '>=', Carbon::now()->subDays(7))->count();

        // 4. Live Darshan & Aarti Data
        $liveDarshan = LiveDarshan::first();
        $aartiTimings = AartiTiming::orderBy('order')->take(4)->get();

        // 5. 6-Month Trend Data for Donation & Booking Charts
        $chartMonths = [];
        $chartDonations = [];
        $chartBookings = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $chartMonths[] = $date->format('M Y');

            $monthSum = Donation::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('amount');
            $chartDonations[] = (int) $monthSum;

            $monthBookings = RoomBooking::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
            $chartBookings[] = (int) $monthBookings;
        }

        // If no donation transactions exist yet for trend, provide baseline sample points for visualization
        $hasDonationTrend = array_sum($chartDonations) > 0;
        if (!$hasDonationTrend && $totalDonationAmount > 0) {
            $chartDonations[5] = (int) $totalDonationAmount;
        }

        // 6. Donations by Cause Breakdown
        $causesBreakdown = Donation::select('cause', DB::raw('count(*) as count'), DB::raw('sum(amount) as total'))
            ->groupBy('cause')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $stats = [
            'total_donations' => '₹ ' . number_format($totalDonationAmount),
            'total_donations_raw' => $totalDonationAmount,
            'today_donations' => '₹ ' . number_format($todayDonationAmount),
            'this_month_donations' => '₹ ' . number_format($thisMonthDonationAmount),
            'donations_count' => $donationsCount,
            'active_bookings' => $activeBookingsCount,
            'pending_bookings' => $pendingBookingsCount,
            'total_bookings' => $totalBookingsCount,
            'committee_count' => $trustCommitteeCount + $gamCommitteeCount,
            'trust_committee_count' => $trustCommitteeCount,
            'gam_committee_count' => $gamCommitteeCount,
            'gallery_count' => $galleryCount,
            'trust_activities_count' => $trustActivitiesCount,
            'blogs_count' => $blogsCount,
            'aarti_count' => $aartiCount,
            'inquiries_count' => $inquiriesCount,
            'pending_inquiries' => $pendingInquiriesCount,
        ];

        // 7. Recent Items
        $recentDonations = Donation::latest()->take(6)->get();
        $recentBookings = RoomBooking::latest()->take(5)->get();
        $recentInquiries = ContactInquiry::latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentDonations',
            'recentBookings',
            'recentInquiries',
            'liveDarshan',
            'aartiTimings',
            'chartMonths',
            'chartDonations',
            'chartBookings',
            'causesBreakdown'
        ));
    }
}
