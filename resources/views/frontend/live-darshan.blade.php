@extends('frontend.layouts.master')

@section('title', __('messages.nav_live_darshan') . ' | ' . __('messages.site_title'))

@section('content')

    <!-- Banner Header (Yellow, White, Orange) -->
    <div class="py-14 bg-gradient-to-b from-orange-50 via-amber-50 to-white border-b-2 border-orange-100 text-center">
        <div class="max-w-4xl mx-auto px-4">
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-100 border-2 border-red-300 text-red-600 text-xs font-black uppercase tracking-wider mb-4 shadow-sm">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-600"></span>
                </span>
                <span>{{ __('messages.live_darshan_badge') }}</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 heading-divine">
                {{ __('messages.live_heading') }}
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-medium">
                {{ __('messages.live_subheading') }}
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Live Video & Shringar Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Video Player Screen (Col 8) -->
            <div class="lg:col-span-8 bg-white border-2 border-orange-200 rounded-3xl p-5 sm:p-6 shadow-xl">
                @php
                    $isGu = app()->getLocale() === 'gu';
                    $rawYt = $live ? $live->youtube_embed_id : null;
                    $cleanYtId = null;
                    if ($rawYt) {
                        $rawYt = trim($rawYt);
                        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|live\/|shorts\/))([\w-]{11})/', $rawYt, $m)) {
                            $cleanYtId = $m[1];
                        } elseif (preg_match('/^[\w-]{11}$/', $rawYt)) {
                            $cleanYtId = $rawYt;
                        }
                    }
                @endphp

                <div class="relative aspect-video rounded-2xl overflow-hidden bg-slate-950 border-2 border-yellow-400 shadow-md flex items-center justify-center">
                    @if($cleanYtId)
                        <iframe class="w-full h-full" 
                                src="https://www.youtube-nocookie.com/embed/{{ $cleanYtId }}?autoplay=1&mute=1&rel=0&playsinline=1&enablejsapi=1" 
                                title="Shree Gatrad Dham Live Darshan" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen>
                        </iframe>
                    @else
                        <div class="text-center p-6">
                            <i class="fa-solid fa-video text-5xl text-yellow-400 mb-3 animate-pulse"></i>
                            <h3 class="text-lg font-bold text-white">{{ __('messages.live_connecting') }}</h3>
                            <p class="text-xs text-slate-300 mt-1">{{ __('messages.live_auto_start') }}</p>
                        </div>
                    @endif
                </div>

                <!-- Video Bottom Info & Controls -->
                <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs">
                    <div>
                        <h3 class="font-bold text-slate-900 text-base flex items-center gap-2">
                            <span>{{ $live ? $live->title : __('messages.live_fallback_title') }}</span>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-red-600 text-white text-[10px] font-black uppercase shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                                <span>LIVE</span>
                            </span>
                        </h3>
                        <p class="text-slate-600 mt-0.5 font-medium">{{ $live ? $live->notice : '' }}</p>
                        <p class="text-[11px] text-amber-700 font-semibold mt-1 flex items-center gap-1.5">
                            <i class="fa-solid fa-volume-high text-orange-600"></i>
                            <span>{{ $isGu ? 'નોંધ: અવાજ શરૂ કરવા માટે વિડીયો પ્લેયરના સ્પીકર આઇકોન પર ક્લિક કરો.' : 'Note: Click the speaker icon on the player to turn on audio.' }}</span>
                        </p>
                    </div>

                    @if($cleanYtId)
                        <a href="https://www.youtube.com/watch?v={{ $cleanYtId }}" target="_blank" class="px-3.5 py-2 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs flex items-center justify-center gap-1.5 shadow-md transition shrink-0 self-start sm:self-center">
                            <i class="fa-brands fa-youtube text-sm"></i>
                            <span>{{ $isGu ? 'YouTube પર જુઓ' : 'Watch on YouTube' }}</span>
                        </a>
                    @endif
                </div>

            </div>

            <!-- Today's Shringar Photo Card (Col 4) -->
            <div class="lg:col-span-4 bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-xl">
                <span class="text-[10px] font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-3 py-1 rounded-full border border-yellow-400">
                    {{ __('messages.today_shringar_badge') }}
                </span>
                <h3 class="text-lg font-black text-slate-900 heading-divine mt-3">
                    {{ __('messages.today_shringar_title') }}
                </h3>
                <p class="text-xs text-slate-500 mt-1 font-semibold">{{ __('messages.today_date') }} {{ date('d F Y') }}</p>

                <div class="mt-4 aspect-[4/5] sm:aspect-square rounded-2xl overflow-hidden border-2 border-yellow-400 shadow-md bg-slate-900 flex items-center justify-center">
                    <img src="{{ $live && $live->today_shringar_image ? $live->today_shringar_image : '/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg' }}" 
                         alt="Today's Darshan" 
                         class="w-full h-full object-cover object-top hover:scale-105 transition duration-500">
                </div>

                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('donation') }}" class="w-full btn-theme-gradient font-bold py-3 rounded-xl text-xs flex items-center justify-center gap-2 shadow-md">
                        <i class="fa-solid fa-hand-holding-dollar text-yellow-200"></i>
                        <span>{{ __('messages.btn_donate_seva') }}</span>
                    </a>
                </div>
            </div>

        </div>

        <!-- Aarti Timings Quick Reminder -->
        <div class="mt-14 bg-white border-2 border-orange-200 rounded-3xl p-6 sm:p-8 shadow-xl">
            <h3 class="text-xl font-black text-slate-900 heading-divine mb-6 text-center">
                {{ __('messages.aarti_heading') }}
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach($aartis as $a)
                    <div class="bg-gradient-to-b from-white to-orange-50/50 border-2 border-orange-100 rounded-2xl p-4 text-center shadow-sm">
                        <span class="text-[10px] font-black text-orange-800 bg-yellow-200 px-2.5 py-0.5 rounded-full border border-yellow-300">{{ $a->badge }}</span>
                        <h4 class="text-xs font-bold text-slate-800 mt-2">{{ $a->title }}</h4>
                        <p class="text-base font-black text-orange-600 mt-1">{{ $a->time }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection
