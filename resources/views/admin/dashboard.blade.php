@extends('admin.layouts.master')

@section('title', app()->getLocale() == 'gu' ? 'ડેશબોર્ડ | શ્રી ગાત્રાળ ધામ એડમિન' : 'Dashboard | Shree Gatrad Dham Admin')

@section('content')

    <!-- Clean Header & Quick Actions -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-900 flex items-center gap-2">
                <span>{{ app()->getLocale() == 'gu' ? 'જય શ્રી ગાત્રાળ માં 🪔' : 'Welcome to Shree Gatrad Dham 🪔' }}</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1 font-semibold">
                @if(app()->getLocale() == 'gu')
                    આજની તારીખ: <span class="text-orange-700 font-bold">{{ date('d F Y, l') }}</span> — મુખ્ય વહીવટી સારાંશ.
                @else
                    Today's Date: <span class="text-orange-700 font-bold">{{ date('l, d F Y') }}</span> — Key Administrative Overview.
                @endif
            </p>
        </div>

        <div class="flex items-center gap-2.5 shrink-0">
            <a href="{{ route('admin.donations.index') }}" class="btn-theme-gradient font-black px-4 py-2.5 rounded-2xl text-xs shadow-md transition flex items-center gap-2">
                <i class="fa-solid fa-receipt text-yellow-200"></i>
                <span>{{ app()->getLocale() == 'gu' ? 'દાન હિસાબ' : 'Donations' }}</span>
            </a>
            <a href="{{ route('home') }}" target="_blank" class="bg-yellow-100 hover:bg-yellow-200 border-2 border-yellow-300 text-orange-900 font-black px-4 py-2.5 rounded-2xl text-xs shadow-sm transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-up-right-from-square text-orange-600"></i>
                <span>{{ app()->getLocale() == 'gu' ? 'વેબસાઇટ' : 'Website' }}</span>
            </a>
        </div>
    </div>

    <!-- 3 Essential KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        
        <!-- Card 1: Total Donations -->
        <div class="admin-card p-5">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs font-bold text-slate-500">{{ app()->getLocale() == 'gu' ? 'કુલ એકત્રિત દાન' : 'Total E-Donations' }}</span>
                    <h3 class="text-2xl font-black text-orange-600 mt-1">{{ $stats['total_donations'] }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-xl shadow-sm border border-orange-200">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-orange-100 flex items-center justify-between text-[11px] text-slate-600">
                <span class="text-emerald-700 font-bold">{{ app()->getLocale() == 'gu' ? 'આ મહિને: ' . $stats['this_month_donations'] : 'This Month: ' . $stats['this_month_donations'] }}</span>
                <a href="{{ route('admin.donations.index') }}" class="text-orange-600 font-bold hover:underline">{{ app()->getLocale() == 'gu' ? 'તપાસો →' : 'View All →' }}</a>
            </div>
        </div>

        <!-- Card 2: Committee Members -->
        <div class="admin-card p-5">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs font-bold text-slate-500">{{ app()->getLocale() == 'gu' ? 'કુલ સમિતિ સભ્યો' : 'Committee Members' }}</span>
                    <h3 class="text-2xl font-black text-emerald-600 mt-1">{{ $stats['committee_count'] }} <span class="text-sm font-semibold">{{ app()->getLocale() == 'gu' ? 'સભ્યો' : 'Members' }}</span></h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shadow-sm border border-emerald-200">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-orange-100 flex items-center justify-between text-[11px] text-slate-600">
                <span>{{ app()->getLocale() == 'gu' ? 'ટ્રસ્ટ: ' . $stats['trust_committee_count'] . ' | ગામ: ' . $stats['gam_committee_count'] : 'Trust: ' . $stats['trust_committee_count'] . ' | Village: ' . $stats['gam_committee_count'] }}</span>
                <a href="{{ route('admin.committees.index', ['type' => 'trust']) }}" class="text-emerald-700 font-bold hover:underline">{{ app()->getLocale() == 'gu' ? 'યાદી →' : 'View →' }}</a>
            </div>
        </div>

        <!-- Card 3: Devotee Inquiries -->
        <div class="admin-card p-5">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs font-bold text-slate-500">{{ app()->getLocale() == 'gu' ? 'સંપર્ક સંદેશાઓ & સહાય' : 'Devotee Inquiries' }}</span>
                    <h3 class="text-2xl font-black text-teal-600 mt-1">{{ $stats['inquiries_count'] }} <span class="text-sm font-semibold">{{ app()->getLocale() == 'gu' ? 'સંદેશાઓ' : 'Messages' }}</span></h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-teal-100 text-teal-700 flex items-center justify-center text-xl shadow-sm border border-teal-200">
                    <i class="fa-solid fa-envelope"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-orange-100 flex items-center justify-between text-[11px] text-slate-600">
                <span class="text-slate-500 font-semibold">{{ app()->getLocale() == 'gu' ? 'યાત્રી સહાય ડેસ્ક' : 'Devotee Helpdesk' }}</span>
                <a href="{{ route('admin.contacts.index') }}" class="text-teal-700 font-bold hover:underline">{{ app()->getLocale() == 'gu' ? 'વાંચો →' : 'Open Inbox →' }}</a>
            </div>
        </div>

    </div>

    <!-- Main Two Essential Tables (Clean & Focused) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Table 1: Recent Donations (Col 7) -->
        <div class="lg:col-span-7 admin-card p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-base font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-hand-holding-dollar text-orange-600"></i>
                        <span>{{ app()->getLocale() == 'gu' ? 'તાજેતરના ઈ-દાન વ્યવહારો (Recent Donations)' : 'Recent E-Donation Transactions' }}</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">{{ app()->getLocale() == 'gu' ? 'છેલ્લા નોંધાયેલા દાનની રસીદો' : 'Latest verified donation receipts' }}</p>
                </div>
                <a href="{{ route('admin.donations.index') }}" class="text-xs text-orange-600 hover:underline font-bold">{{ app()->getLocale() == 'gu' ? 'બધા જુઓ →' : 'View All →' }}</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-orange-50 text-orange-950 uppercase font-black text-[10px] border-b-2 border-orange-200">
                        <tr>
                            <th class="p-3">{{ app()->getLocale() == 'gu' ? 'રસીદ નં.' : 'Receipt No.' }}</th>
                            <th class="p-3">{{ app()->getLocale() == 'gu' ? 'દાતાનું નામ' : 'Donor Name' }}</th>
                            <th class="p-3">{{ app()->getLocale() == 'gu' ? 'સેવા હેતુ' : 'Purpose' }}</th>
                            <th class="p-3">{{ app()->getLocale() == 'gu' ? 'મોડ' : 'Mode' }}</th>
                            <th class="p-3 text-right">{{ app()->getLocale() == 'gu' ? 'રકમ' : 'Amount' }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentDonations as $d)
                            <tr class="hover:bg-orange-50/50 transition">
                                <td class="p-3 font-mono font-bold text-orange-600">{{ $d->receipt_no }}</td>
                                <td class="p-3 font-bold text-slate-900">
                                    {{ $d->donor_name }}
                                    <span class="block text-[10px] text-slate-400 font-mono">{{ $d->phone }}</span>
                                </td>
                                <td class="p-3 text-slate-700 text-[11px] font-semibold">
                                    <span class="bg-orange-50 border border-orange-200 px-2 py-0.5 rounded text-orange-800">
                                        {{ $d->cause }}
                                    </span>
                                </td>
                                <td class="p-3 text-slate-600 text-[10px] font-bold">{{ $d->payment_mode ?? 'UPI' }}</td>
                                <td class="p-3 text-right">
                                    <span class="font-black text-emerald-600 text-sm">₹ {{ number_format($d->amount) }}</span>
                                    <span class="block text-[10px] text-slate-400">{{ $d->created_at->format('d M') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-6 text-center text-slate-400 font-bold">
                                    {{ app()->getLocale() == 'gu' ? 'હજુ સુધી કોઈ દાન નોંધાયેલ નથી.' : 'No donation records found yet.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Table 2: Recent Devotee Inquiries (Col 5) -->
        <div class="lg:col-span-5 admin-card p-6">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h2 class="text-base font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-teal-600"></i>
                        <span>{{ app()->getLocale() == 'gu' ? 'સંપર્ક સંદેશાઓ (Inquiries)' : 'Devotee Inquiries' }}</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">{{ app()->getLocale() == 'gu' ? 'તાજેતરના યાત્રી સંદેશાઓ' : 'Recent devotee messages & queries' }}</p>
                </div>
                <a href="{{ route('admin.contacts.index') }}" class="text-xs text-teal-600 hover:underline font-bold">{{ app()->getLocale() == 'gu' ? 'બધા જુઓ →' : 'View All →' }}</a>
            </div>

            <div class="space-y-3">
                @forelse($recentInquiries as $inq)
                    <div class="p-3 rounded-2xl border border-orange-100 bg-orange-50/30 flex items-center justify-between hover:border-orange-300 transition">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xs text-slate-900">{{ $inq->name }}</span>
                                <span class="text-[10px] font-mono text-slate-400">({{ $inq->phone }})</span>
                            </div>
                            <div class="text-[11px] text-slate-600 mt-1 line-clamp-1">
                                {{ $inq->subject ?: $inq->message }}
                            </div>
                        </div>

                        <span class="text-[10px] font-bold text-slate-400 shrink-0">
                            {{ $inq->created_at ? $inq->created_at->format('d M') : '' }}
                        </span>
                    </div>
                @empty
                    <p class="p-6 text-center text-slate-400 font-bold text-xs">
                        {{ app()->getLocale() == 'gu' ? 'હજુ સુધી કોઈ સંદેશાઓ મળેલ નથી.' : 'No devotee inquiries found.' }}
                    </p>
                @endforelse
            </div>
        </div>

    </div>

@endsection
