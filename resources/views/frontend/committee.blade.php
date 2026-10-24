@extends('frontend.layouts.master')

@section('title', ($pageType === 'trust' ? __('messages.trust_committee_heading') : __('messages.gam_committee_heading')) . ' | ' . __('messages.site_title'))

@section('content')

    <!-- Banner Header (Yellow, White, Orange) -->
    <div class="py-14 bg-gradient-to-b from-orange-50 via-amber-50 to-white border-b-2 border-orange-100 text-center">
        <div class="max-w-4xl mx-auto px-4">
            
            <!-- Type Switcher Badges -->
            <div class="inline-flex rounded-2xl bg-white border-2 border-orange-200 p-1 mb-4 shadow-sm text-xs">
                <a href="{{ route('committee.trust') }}" class="px-5 py-2 rounded-xl font-black transition flex items-center gap-2 {{ $pageType === 'trust' ? 'bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-md' : 'text-slate-600 hover:text-orange-600' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>{{ __('messages.nav_committee') }}</span>
                </a>
                <a href="{{ route('committee.gam') }}" class="px-5 py-2 rounded-xl font-black transition flex items-center gap-2 {{ $pageType === 'gam' ? 'bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-md' : 'text-slate-600 hover:text-orange-600' }}">
                    <i class="fa-solid fa-people-roof"></i>
                    <span>{{ __('messages.nav_gam_committee') }}</span>
                </a>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 heading-divine mt-2">
                {{ $pageType === 'trust' ? __('messages.trust_committee_heading') : __('messages.gam_committee_heading') }}
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-medium">
                {{ __('messages.committee_subheading') }}
            </p>
        </div>
    </div>

    <!-- Committee Members Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($members as $member)
                <div class="bg-white border-2 border-orange-200 hover:border-orange-500 rounded-3xl p-6 shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 group flex flex-col justify-between">
                    
                    <div>
                        <!-- Member Photo / Avatar -->
                        <div class="relative w-32 h-32 mx-auto mb-5">
                            <div class="w-full h-full rounded-2xl overflow-hidden border-2 border-yellow-400 p-1 bg-white shadow-md group-hover:scale-105 transition-transform duration-300">
                                @if($member->photo_url)
                                    <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" class="w-full h-full object-cover rounded-xl">
                                @else
                                    <div class="w-full h-full rounded-xl bg-orange-50 flex items-center justify-center text-orange-500 text-4xl font-bold">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                            </div>
                            <span class="absolute -bottom-2 right-1/2 translate-x-1/2 bg-yellow-400 text-yellow-950 font-black text-[10px] px-3 py-0.5 rounded-full shadow border border-yellow-500">
                                #{{ $member->order }}
                            </span>
                        </div>

                        <!-- Info -->
                        <div class="text-center">
                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-orange-600 transition-colors">
                                {{ $member->name }}
                            </h3>
                            <div class="inline-block mt-2 text-xs font-black text-orange-800 bg-yellow-100 px-3.5 py-1 rounded-full border border-yellow-300">
                                {{ $member->designation }}
                            </div>

                            @if($member->village)
                                <p class="text-xs text-slate-600 mt-2.5 flex items-center justify-center gap-1.5 font-medium">
                                    <i class="fa-solid fa-location-dot text-orange-500 text-xs"></i>
                                    <span>{{ $member->village }}</span>
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Footer / Phone -->
                    <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                        <span class="text-[11px] font-semibold text-orange-700 bg-orange-50 px-2.5 py-1 rounded-lg">
                            <i class="fa-solid fa-shield-halved text-orange-600 mr-1"></i>
                            {{ $pageType === 'trust' ? __('messages.badge_trust_mandal') : __('messages.badge_samaj_seva') }}
                        </span>
                        @if($member->phone)
                            <a href="tel:{{ $member->phone }}" class="text-orange-600 hover:text-orange-700 font-mono font-bold flex items-center gap-1">
                                <i class="fa-solid fa-phone text-[10px]"></i>
                                <span>{{ $member->phone }}</span>
                            </a>
                        @endif
                    </div>

                </div>
            @empty
                <div class="col-span-full bg-white border-2 border-dashed border-orange-200 rounded-3xl p-12 text-center text-slate-500 text-sm font-semibold">
                    <i class="fa-solid fa-users text-4xl text-orange-400 mb-3 block"></i>
                    {{ app()->getLocale() == 'gu' ? 'હાલમાં કોઈ સમિતિ સભ્યો નોંધાયેલ નથી. એડમિન પેનલમાંથી ઉમેરી શકો છો.' : 'No committee members listed yet. Add members from admin panel.' }}
                </div>
            @endforelse
        </div>

    </div>

@endsection
