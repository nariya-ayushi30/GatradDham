@extends('frontend.layouts.master')

@section('title', __('messages.site_title') . ' | ' . __('messages.site_subtitle'))

@section('content')

    <!-- GRAND DEVOTIONAL HERO SLIDER (Self-Contained, Bulletproof Temple Engine) -->
    <style>
        .gatrad-hero-container {
            position: relative;
            width: 100%;
            min-height: 580px;
            height: 580px;
            background-color: #030712;
            overflow: hidden;
            user-select: none;
        }
        @media (min-width: 640px) {
            .gatrad-hero-container {
                min-height: 640px;
                height: 640px;
            }
        }
        @media (min-width: 1024px) {
            .gatrad-hero-container {
                min-height: 700px;
                height: 700px;
            }
        }
        .gatrad-slide-item {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            visibility: hidden;
            transition: opacity 900ms cubic-bezier(0.4, 0, 0.2, 1), visibility 900ms cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1;
            pointer-events: none;
        }
        .gatrad-slide-item.active-slide {
            opacity: 1 !important;
            visibility: visible !important;
            z-index: 10 !important;
            pointer-events: auto !important;
        }
        .gatrad-slide-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            filter: brightness(0.92) contrast(1.05);
            transform: scale(1);
            transition: transform 7s cubic-bezier(0.25, 1, 0.5, 1);
        }
        .gatrad-slide-item.active-slide .gatrad-slide-img {
            transform: scale(1.03);
        }
    </style>

    <section id="gatradHeroSlider" class="gatrad-hero-container relative overflow-hidden bg-slate-950 text-white flex items-center justify-center select-none" style="position: relative; min-height: 640px; height: 640px; width: 100%; overflow: hidden; background: #030712;">

        <!-- ==================== SLIDE 1: MAIN TEMPLE IDENTITY (Shree Gatrad Dham & Trust) ==================== -->
        <div class="gatrad-slide-item active-slide" style="opacity: 1; visibility: visible; z-index: 10; pointer-events: auto;">
            <img 
                src="{{ (isset($sliders[0]) && $sliders[0]->image ? $sliders[0]->image : '/uploads/sliders/banner_1.jpg') . '?v=' . filemtime(public_path('uploads/sliders/banner_1.jpg')) }}" 
                alt="Shree Gatrad Dham" 
                class="gatrad-slide-img"
                onerror="this.onerror=null; this.src='/uploads/sliders/banner_1.jpg';"
            />
            <!-- Left-focused vignette so text is crisp on left while right side of image remains completely open & clear -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/45 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>

            <div class="relative z-10 max-w-7xl mx-auto pl-12 sm:pl-20 lg:pl-24 pr-4 sm:pr-8 w-full h-full flex flex-col justify-center items-start text-left py-12">
                <div class="max-w-xl text-left">
                    <!-- Sacred Badge -->
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-black/60 backdrop-blur-md border border-amber-400/80 text-amber-300 text-[11px] sm:text-xs font-bold mb-3 shadow-lg">
                        <span class="text-amber-400">🪔</span>
                        <span>{{ app()->getLocale() == 'gu' ? 'પવિત્ર તીર્થધામ - દેવગામ (અમરેલી)' : 'Sacred Pilgrimage - Devgam (Amreli)' }}</span>
                        <span class="text-amber-400">🪔</span>
                    </div>

                    <!-- Main Title: Aligned to one side (Left) -->
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black heading-divine tracking-tight mb-2 leading-tight">
                        <span class="block bg-gradient-to-r from-amber-200 via-yellow-300 to-orange-300 bg-clip-text text-transparent drop-shadow-[0_2px_10px_rgba(0,0,0,0.95)] pb-0.5">
                            {{ app()->getLocale() == 'gu' ? ($sliders[0]->title_gu ?? __('messages.site_title')) : ($sliders[0]->title_en ?? __('messages.site_title')) }}
                        </span>
                        <span class="block text-white text-xs sm:text-sm md:text-base lg:text-lg font-bold mt-1 text-slate-100 drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">
                            {{ app()->getLocale() == 'gu' ? ($sliders[0]->subtitle_gu ?? __('messages.site_subtitle')) : ($sliders[0]->subtitle_en ?? __('messages.site_subtitle')) }}
                        </span>
                    </h1>

                    <p class="text-slate-200 text-xs sm:text-xs md:text-sm max-w-lg mb-5 leading-relaxed font-medium line-clamp-2 drop-shadow-[0_2px_6px_rgba(0,0,0,0.9)]">
                        {{ __('messages.footer_about') }}
                    </p>

                    <!-- Action Buttons: Left Aligned -->
                    <div class="flex flex-wrap justify-start gap-2.5 sm:gap-3 items-center">
                        <a href="#aarti-schedule" class="btn-theme-gradient font-black px-5 sm:px-6 py-2.5 rounded-xl text-xs flex items-center gap-1.5 transition hover:scale-105 shadow-xl">
                            <i class="fa-solid fa-bell text-yellow-200 text-xs"></i>
                            <span>{{ isset($sliders[0]) && $sliders[0]->button_text_gu ? (app()->getLocale() == 'gu' ? $sliders[0]->button_text_gu : $sliders[0]->button_text_en) : __('messages.btn_aarti_time') }}</span>
                        </a>
                        
                        <a href="{{ route('live.darshan') }}" class="bg-red-600 hover:bg-red-500 text-white font-black px-5 sm:px-6 py-2.5 rounded-xl text-xs flex items-center gap-1.5 shadow-xl hover:scale-105 transition border border-red-400">
                            <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
                            <span>{{ __('messages.nav_live_darshan') }}</span>
                        </a>

                        <a href="{{ route('donation') }}" class="bg-yellow-400 hover:bg-yellow-300 text-slate-950 font-black px-5 sm:px-6 py-2.5 rounded-xl text-xs flex items-center gap-1.5 shadow-xl hover:scale-105 transition border border-yellow-500">
                            <i class="fa-solid fa-hand-holding-dollar text-orange-700 text-xs"></i>
                            <span>{{ __('messages.btn_donate') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== SLIDE 2: DAILY AARTI & LIVE DARSHAN ==================== -->
        <div class="gatrad-slide-item">
            <img 
                src="{{ (isset($sliders[1]) && $sliders[1]->image ? $sliders[1]->image : '/uploads/sliders/banner_2.jpg') . '?v=' . filemtime(public_path('uploads/sliders/banner_2.jpg')) }}" 
                alt="Daily Aarti & Live Darshan" 
                class="gatrad-slide-img"
                onerror="this.onerror=null; this.src='/uploads/sliders/banner_2.jpg';"
            />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/45 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>

            <div class="relative z-10 max-w-7xl mx-auto pl-12 sm:pl-20 lg:pl-24 pr-4 sm:pr-8 w-full h-full flex flex-col justify-center items-start text-left py-12">
                <div class="max-w-xl text-left">
                    <!-- Sacred Badge -->
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-black/60 backdrop-blur-md border border-orange-400/80 text-orange-300 text-[11px] sm:text-xs font-bold mb-3 shadow-lg">
                        <span class="text-orange-400">🪔</span>
                        <span>{{ app()->getLocale() == 'gu' ? 'દૈનિક મંગળા, શૃંગાર & સંધ્યા આરતી દર્શન' : 'Daily Mangla, Shringar & Sandhya Aarti Darshan' }}</span>
                        <span class="text-orange-400">🪔</span>
                    </div>

                    <!-- Main Title -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black heading-divine tracking-tight mb-2 leading-tight">
                        <span class="block bg-gradient-to-r from-yellow-200 via-amber-300 to-orange-300 bg-clip-text text-transparent drop-shadow-[0_2px_10px_rgba(0,0,0,0.95)] pb-0.5">
                            {{ app()->getLocale() == 'gu' ? ($sliders[1]->title_gu ?? 'દૈનિક આરતી & લાઈવ દર્શન') : ($sliders[1]->title_en ?? 'Daily Aarti & Live Darshan') }}
                        </span>
                        <span class="block text-white text-xs sm:text-sm md:text-base lg:text-lg font-bold mt-1 text-slate-100 drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">
                            {{ app()->getLocale() == 'gu' ? ($sliders[1]->subtitle_gu ?? 'ઘેર બેઠા મેળવો માતાજીના પાવન દર્શન અને આશીર્વાદ') : ($sliders[1]->subtitle_en ?? 'Spiritual Blessings Delivered To Your Home') }}
                        </span>
                    </h2>

                    <p class="text-slate-200 text-xs sm:text-xs md:text-sm max-w-lg mb-5 leading-relaxed font-medium line-clamp-2 drop-shadow-[0_2px_6px_rgba(0,0,0,0.9)]">
                        {{ __('messages.live_subheading') }}
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap justify-start gap-2.5 sm:gap-3 items-center">
                        <a href="{{ route('live.darshan') }}" class="btn-theme-gradient font-black px-5 sm:px-6 py-2.5 rounded-xl text-xs flex items-center gap-1.5 transition hover:scale-105 shadow-xl">
                            <i class="fa-solid fa-video text-yellow-200 text-xs"></i>
                            <span>{{ __('messages.nav_live_darshan') }}</span>
                        </a>

                        <a href="#aarti-schedule" class="bg-white/20 hover:bg-white/30 text-white font-bold px-5 sm:px-6 py-2.5 rounded-xl text-xs flex items-center gap-1.5 backdrop-blur-md border border-white/40 transition hover:scale-105 shadow-xl">
                            <i class="fa-solid fa-clock text-amber-300 text-xs"></i>
                            <span>{{ __('messages.btn_aarti_time') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== SLIDE 3: SADAVRAT ANNAKSHETRA MAHAPRASAD ==================== -->
        <div class="gatrad-slide-item">
            <img 
                src="{{ (isset($sliders[2]) && $sliders[2]->image ? $sliders[2]->image : '/uploads/sliders/banner_3.jpg') . '?v=' . filemtime(public_path('uploads/sliders/banner_3.jpg')) }}" 
                alt="Sadavrat Mahaprasad Annakshetra" 
                class="gatrad-slide-img"
                onerror="this.onerror=null; this.src='/uploads/sliders/banner_3.jpg';"
            />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/45 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>

            <div class="relative z-10 max-w-7xl mx-auto pl-12 sm:pl-20 lg:pl-24 pr-4 sm:pr-8 w-full h-full flex flex-col justify-center items-start text-left py-12">
                <div class="max-w-xl text-left">
                    <!-- Sacred Badge -->
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-black/60 backdrop-blur-md border border-emerald-400/80 text-emerald-300 text-[11px] sm:text-xs font-bold mb-3 shadow-lg">
                        <span class="text-emerald-400">🌾</span>
                        <span>{{ app()->getLocale() == 'gu' ? 'માનવ સેવા એ જ પ્રભુ સેવા - સદાવ્રત અન્નક્ષેત્ર' : 'Service to Humanity is Service to God' }}</span>
                        <span class="text-emerald-400">🌾</span>
                    </div>

                    <!-- Main Title -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black heading-divine tracking-tight mb-2 leading-tight">
                        <span class="block bg-gradient-to-r from-amber-200 via-yellow-300 to-orange-300 bg-clip-text text-transparent drop-shadow-[0_2px_10px_rgba(0,0,0,0.95)] pb-0.5">
                            {{ app()->getLocale() == 'gu' ? ($sliders[2]->title_gu ?? 'સદાવ્રત અન્નક્ષેત્ર મહાપ્રસાદ સેવા') : ($sliders[2]->title_en ?? 'Sadavrat Mahaprasad Annakshetra') }}
                        </span>
                        <span class="block text-white text-xs sm:text-sm md:text-base lg:text-lg font-bold mt-1 text-slate-100 drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">
                            {{ app()->getLocale() == 'gu' ? ($sliders[2]->subtitle_gu ?? 'યાત્રાળુઓ માટે નિઃશુલ્ક શુદ્ધ સાત્વિક ભોજન પ્રસાદ') : ($sliders[2]->subtitle_en ?? 'Free Satvik Food For Every Pilgrim') }}
                        </span>
                    </h2>

                    <p class="text-slate-200 text-xs sm:text-xs md:text-sm max-w-lg mb-5 leading-relaxed font-medium line-clamp-2 drop-shadow-[0_2px_6px_rgba(0,0,0,0.9)]">
                        {{ app()->getLocale() == 'gu' ? 'મંદિરે પધારતા તમામ ભાવિક ભક્તો અને યાત્રાળુઓ માટે દૈનિક શુદ્ધ સાત્વિક ભોજન પ્રસાદની નિઃશુલ્ક વ્યવસ્થા.' : 'Hygienic and nutritious Satvik Mahaprasad served daily to devotees and pilgrims without any charges.' }}
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap justify-start gap-2.5 sm:gap-3 items-center">
                        <a href="{{ route('donation') }}" class="btn-theme-gradient font-black px-5 sm:px-6 py-2.5 rounded-xl text-xs flex items-center gap-1.5 transition hover:scale-105 shadow-xl">
                            <i class="fa-solid fa-bowl-rice text-yellow-200 text-xs"></i>
                            <span>{{ __('messages.btn_donate_annakshetra') }}</span>
                        </a>

                        <a href="{{ route('trust') }}" class="bg-white/20 hover:bg-white/30 text-white font-bold px-5 sm:px-6 py-2.5 rounded-xl text-xs flex items-center gap-1.5 backdrop-blur-md border border-white/40 transition hover:scale-105 shadow-xl">
                            <i class="fa-solid fa-hands-holding-child text-yellow-300 text-xs"></i>
                            <span>{{ __('messages.nav_trust') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== SLIDE 4: YATRIK BHAVAN & GAUSHALA ==================== -->
        <div class="gatrad-slide-item">
            <img 
                src="{{ (isset($sliders[3]) && $sliders[3]->image ? $sliders[3]->image : '/uploads/sliders/banner_4.jpg') . '?v=' . filemtime(public_path('uploads/sliders/banner_4.jpg')) }}" 
                alt="Yatrik Dharamshala & Gaushala" 
                class="gatrad-slide-img"
                onerror="this.onerror=null; this.src='/uploads/sliders/banner_4.jpg';"
            />
            <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/45 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>

            <div class="relative z-10 max-w-7xl mx-auto pl-12 sm:pl-20 lg:pl-24 pr-4 sm:pr-8 w-full h-full flex flex-col justify-center items-start text-left py-12">
                <div class="max-w-xl text-left">
                    <!-- Sacred Badge -->
                    <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-black/60 backdrop-blur-md border border-amber-400/80 text-amber-300 text-[11px] sm:text-xs font-bold mb-3 shadow-lg">
                        <span class="text-amber-400">🚩</span>
                        <span>{{ app()->getLocale() == 'gu' ? 'યાત્રિક સુવિધા & પવિત્ર ગૌમાતા સેવા' : 'Pilgrim Facilities & Gau Seva' }}</span>
                        <span class="text-amber-400">🚩</span>
                    </div>

                    <!-- Main Title -->
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black heading-divine tracking-tight mb-2 leading-tight">
                        <span class="block bg-gradient-to-r from-yellow-200 via-amber-300 to-orange-300 bg-clip-text text-transparent drop-shadow-[0_2px_10px_rgba(0,0,0,0.95)] pb-0.5">
                            {{ app()->getLocale() == 'gu' ? ($sliders[3]->title_gu ?? 'યાત્રિક ભવન ધર્મશાળા & ગૌશાળા') : ($sliders[3]->title_en ?? 'Yatrik Dharamshala & Gaushala') }}
                        </span>
                        <span class="block text-white text-xs sm:text-sm md:text-base lg:text-lg font-bold mt-1 text-slate-100 drop-shadow-[0_2px_8px_rgba(0,0,0,0.9)]">
                            {{ app()->getLocale() == 'gu' ? ($sliders[3]->subtitle_gu ?? 'શાંત અને પવિત્ર વાતાવરણમાં રોકાણ') : ($sliders[3]->subtitle_en ?? 'Peaceful Stay & Sacred Gau Mata Seva') }}
                        </span>
                    </h2>

                    <p class="text-slate-200 text-xs sm:text-xs md:text-sm max-w-lg mb-5 leading-relaxed font-medium line-clamp-2 drop-shadow-[0_2px_6px_rgba(0,0,0,0.9)]">
                        {{ app()->getLocale() == 'gu' ? 'યાત્રાળુઓ માટે આધુનિક સુવિધાવાળા AC / Non-AC ઓરડાઓ, સ્વચ્છ પરિસર અને પ્રેમપૂર્વક ગૌમાતા સેવાની સુવિધા.' : 'Clean AC & Non-AC guest rooms with peaceful ambiance, friendly hospitality, and sacred Gaushala seva.' }}
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap justify-start gap-2.5 sm:gap-3 items-center">
                        <a href="{{ route('contact') }}" class="btn-theme-gradient font-black px-6 sm:px-7 py-2.5 rounded-xl text-xs flex items-center gap-1.5 transition hover:scale-105 shadow-xl">
                            <i class="fa-solid fa-phone text-yellow-200 text-xs"></i>
                            <span>{{ __('messages.btn_call_us') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Dynamic Sliders from Database (if more than 4 added by Admin) -->
        @if(isset($sliders) && $sliders->count() > 4)
            @foreach($sliders->slice(4) as $extraSlider)
                <div class="gatrad-slide-item">
                    <img 
                        src="{{ $extraSlider->image }}" 
                        alt="{{ $extraSlider->title_gu ?? $extraSlider->title_en }}" 
                        class="gatrad-slide-img"
                        onerror="this.onerror=null; this.src='/uploads/sliders/banner_1.jpg';"
                    />
                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/45 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>

                    <div class="relative z-10 max-w-7xl mx-auto pl-12 sm:pl-20 lg:pl-24 pr-4 sm:pr-8 w-full h-full flex flex-col justify-center items-start text-left py-12">
                        <div class="max-w-xl text-left">
                            <div class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-white/15 backdrop-blur-md border border-yellow-400/90 text-yellow-300 text-[11px] sm:text-xs font-bold mb-3 shadow-xl">
                                <span class="text-yellow-400">🪔</span>
                                <span>{{ __('messages.mantra') }}</span>
                                <span class="text-yellow-400">🪔</span>
                            </div>

                            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-black heading-divine tracking-tight mb-2 leading-tight">
                                <span class="block bg-gradient-to-r from-amber-300 via-yellow-400 to-orange-400 bg-clip-text text-transparent drop-shadow-[0_2px_10px_rgba(251,191,36,0.6)] pb-0.5">
                                    {{ app()->getLocale() == 'gu' ? ($extraSlider->title_gu ?? $extraSlider->title_en) : ($extraSlider->title_en ?? $extraSlider->title_gu) }}
                                </span>
                                @if($extraSlider->subtitle_gu || $extraSlider->subtitle_en)
                                    <span class="block text-white text-xs sm:text-sm md:text-base lg:text-lg font-bold mt-1 text-slate-100 drop-shadow-md">
                                        {{ app()->getLocale() == 'gu' ? ($extraSlider->subtitle_gu ?? $extraSlider->subtitle_en) : ($extraSlider->subtitle_en ?? $extraSlider->subtitle_gu) }}
                                    </span>
                                @endif
                            </h2>

                            @if($extraSlider->button_link)
                                <div class="flex flex-wrap justify-start gap-2.5 sm:gap-3 items-center mt-4">
                                    <a href="{{ $extraSlider->button_link }}" class="btn-theme-gradient font-black px-5 sm:px-6 py-2.5 rounded-xl text-xs flex items-center gap-1.5 transition hover:scale-105 shadow-xl">
                                        <span>{{ app()->getLocale() == 'gu' ? ($extraSlider->button_text_gu ?? 'વધુ માહિતી') : ($extraSlider->button_text_en ?? 'Learn More') }}</span>
                                        <i class="fa-solid fa-arrow-right text-xs"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- ==================== CAROUSEL CONTROLS ==================== -->
        <!-- Prev Button -->
        <button 
            id="gatradSliderPrev"
            type="button"
            aria-label="Previous Slide" 
            class="absolute left-2 sm:left-7 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-black/50 hover:bg-orange-600 text-white border border-white/30 hover:border-orange-400 backdrop-blur-md flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-2xl group cursor-pointer"
        >
            <i class="fa-solid fa-chevron-left text-sm sm:text-lg group-hover:-translate-x-0.5 transition-transform"></i>
        </button>

        <!-- Next Button -->
        <button 
            id="gatradSliderNext"
            type="button"
            aria-label="Next Slide" 
            class="absolute right-2 sm:right-7 top-1/2 -translate-y-1/2 z-30 w-11 h-11 sm:w-14 sm:h-14 rounded-full bg-black/50 hover:bg-orange-600 text-white border border-white/30 hover:border-orange-400 backdrop-blur-md flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-2xl group cursor-pointer"
        >
            <i class="fa-solid fa-chevron-right text-sm sm:text-lg group-hover:translate-x-0.5 transition-transform"></i>
        </button>

        <!-- Slide Indicators & Numeric Counter at Bottom -->
        @php
            $sliderTotalCount = max(4, isset($sliders) ? $sliders->count() : 4);
        @endphp
        <div class="absolute bottom-5 sm:bottom-7 left-1/2 -translate-x-1/2 z-30 flex items-center gap-2 sm:gap-3 bg-black/70 backdrop-blur-md border border-white/25 px-3.5 sm:px-5 py-2 rounded-full shadow-2xl">
            @for($i = 0; $i < $sliderTotalCount; $i++)
                <button 
                    type="button"
                    class="gatrad-slider-dot {{ $i === 0 ? 'w-8 sm:w-10 bg-yellow-400' : 'w-2.5 bg-white/40 hover:bg-white/80' }} h-2.5 rounded-full transition-all duration-300 cursor-pointer"
                    data-slide-index="{{ $i }}"
                    aria-label="Go to slide {{ $i + 1 }}"
                ></button>
            @endfor
            <span id="gatradSliderCounter" class="text-[11px] sm:text-xs font-black text-yellow-300 ml-1.5 tracking-wider font-mono">
                01 / {{ sprintf('%02d', $sliderTotalCount) }}
            </span>
        </div>
    </section>

    <!-- Bulletproof Zero-Dependency Slider Controller -->
    <script>
        (function() {
            function initGatradHeroSlider() {
                var container = document.getElementById('gatradHeroSlider');
                if (!container) return;

                var slides = container.querySelectorAll('.gatrad-slide-item');
                var dots = container.querySelectorAll('.gatrad-slider-dot');
                var counterEl = document.getElementById('gatradSliderCounter');
                var prevBtn = document.getElementById('gatradSliderPrev');
                var nextBtn = document.getElementById('gatradSliderNext');

                if (slides.length <= 1) return;

                var currentIndex = 0;
                var totalSlides = slides.length;
                var autoPlayTimer = null;

                function renderSlide(newIndex) {
                    if (slides[currentIndex]) {
                        slides[currentIndex].classList.remove('active-slide');
                    }
                    if (dots[currentIndex]) {
                        dots[currentIndex].classList.remove('w-8', 'sm:w-10', 'bg-yellow-400');
                        dots[currentIndex].classList.add('w-2.5', 'bg-white/40');
                    }

                    currentIndex = (newIndex + totalSlides) % totalSlides;

                    if (slides[currentIndex]) {
                        slides[currentIndex].classList.add('active-slide');
                    }
                    if (dots[currentIndex]) {
                        dots[currentIndex].classList.remove('w-2.5', 'bg-white/40');
                        dots[currentIndex].classList.add('w-8', 'sm:w-10', 'bg-yellow-400');
                    }

                    if (counterEl) {
                        var curr = String(currentIndex + 1).padStart(2, '0');
                        var tot = String(totalSlides).padStart(2, '0');
                        counterEl.textContent = curr + ' / ' + tot;
                    }
                }

                function startTimer() {
                    stopTimer();
                    autoPlayTimer = setInterval(function() {
                        renderSlide(currentIndex + 1);
                    }, 5500);
                }

                function stopTimer() {
                    if (autoPlayTimer) {
                        clearInterval(autoPlayTimer);
                        autoPlayTimer = null;
                    }
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        renderSlide(currentIndex - 1);
                        startTimer();
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        renderSlide(currentIndex + 1);
                        startTimer();
                    });
                }

                dots.forEach(function(dot, idx) {
                    dot.addEventListener('click', function(e) {
                        e.preventDefault();
                        renderSlide(idx);
                        startTimer();
                    });
                });

                container.addEventListener('mouseenter', stopTimer);
                container.addEventListener('mouseleave', startTimer);

                // Touch swipe for mobile devices
                var touchStartX = 0;
                container.addEventListener('touchstart', function(e) {
                    if (e.touches && e.touches[0]) {
                        touchStartX = e.touches[0].clientX;
                    }
                }, { passive: true });

                container.addEventListener('touchend', function(e) {
                    if (e.changedTouches && e.changedTouches[0]) {
                        var touchEndX = e.changedTouches[0].clientX;
                        var diff = touchStartX - touchEndX;
                        if (Math.abs(diff) > 40) {
                            if (diff > 0) {
                                renderSlide(currentIndex + 1);
                            } else {
                                renderSlide(currentIndex - 1);
                            }
                            startTimer();
                        }
                    }
                }, { passive: true });

                startTimer();
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initGatradHeroSlider);
            } else {
                initGatradHeroSlider();
            }
        })();
    </script>

    <!-- FLOATING LIVE DARSHAN NOTICE BAR -->
    @if($live)
        <div class="relative z-20 -mt-6 sm:-mt-7 max-w-4xl mx-auto px-4 mb-8">
            <div class="bg-white border-2 border-orange-400/90 rounded-3xl p-3.5 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-2xl">
                <div class="flex items-center gap-3.5 text-left w-full sm:w-auto">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-500 text-white flex items-center justify-center shrink-0 shadow-md">
                        <i class="fa-solid fa-video text-lg animate-pulse"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-red-600 animate-ping"></span>
                            <span class="text-[10px] sm:text-[11px] text-orange-600 font-black uppercase tracking-wider">{{ __('messages.live_darshan_badge') }}</span>
                        </div>
                        <div class="text-xs sm:text-sm font-bold text-slate-800 truncate sm:whitespace-normal mt-0.5">{{ $live->notice }}</div>
                    </div>
                </div>
                <a href="{{ route('live.darshan') }}" class="w-full sm:w-auto shrink-0 btn-theme-gradient px-5 py-2.5 rounded-2xl text-xs sm:text-sm font-black flex items-center justify-center gap-2 shadow-md hover:scale-105 transition">
                    <span>{{ __('messages.nav_live_darshan') }}</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    @endif

    <!-- SECTION 1: DYNAMIC AARTI SCHEDULE -->
    <section id="aarti-schedule" class="py-16 lg:py-24 bg-white border-b border-orange-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-100 px-4 py-1.5 rounded-full border border-yellow-300 shadow-sm">
                    {{ __('messages.btn_daily_schedule') }}
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 mt-3 heading-divine">
                    {{ __('messages.aarti_heading') }}
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm mt-2 font-medium">
                    {{ __('messages.aarti_subheading') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-5">
                @forelse($aartis as $item)
                    <div class="bg-gradient-to-b from-white to-orange-50/40 border-2 border-orange-200 hover:border-orange-500 rounded-3xl p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl flex flex-col justify-between group shadow-md">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="w-8 h-8 rounded-xl bg-orange-600 text-white flex items-center justify-center text-xs font-black shadow">
                                    #{{ $item->order }}
                                </span>
                                <span class="text-[10px] font-black px-2.5 py-1 rounded-full bg-yellow-200 text-yellow-900 border border-yellow-400">
                                    {{ $item->badge }}
                                </span>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 group-hover:text-orange-600 transition">
                                {{ $item->title }}
                            </h3>
                            <div class="text-lg font-black text-orange-600 mt-1">
                                {{ $item->time }}
                            </div>
                            <p class="text-xs text-slate-600 mt-2 leading-relaxed font-normal">
                                {{ $item->desc }}
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-orange-200/60 text-[11px] text-orange-800 font-bold">
                            <i class="fa-solid fa-clock mr-1 text-orange-500"></i> {{ __('messages.btn_punctuality') }}
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-orange-50/50 border-2 border-dashed border-orange-200 rounded-3xl p-8 text-center text-slate-500 text-xs font-semibold">
                        <i class="fa-solid fa-bell text-3xl text-orange-400 mb-2 block"></i>
                        {{ app()->getLocale() == 'gu' ? 'હાલમાં આરતી સમયપત્રક અપડેટ થઈ રહ્યું છે. એડમિન પેનલમાંથી વિગતો ઉમેરી શકો છો.' : 'Aarti schedule will be updated shortly from admin panel.' }}
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- SECTION 2: DYNAMIC TRUST SEVA ACTIVITIES -->
    <section class="py-16 lg:py-24 bg-gradient-to-b from-orange-50/40 via-amber-50/20 to-white border-b border-orange-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm">
                    {{ __('messages.human_service') }}
                </span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 mt-3 heading-divine">
                    {{ __('messages.trust_heading') }}
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm mt-2 font-medium">
                    {{ __('messages.trust_subheading') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($services as $srv)
                    <div class="bg-white border-2 border-orange-200 hover:border-orange-500 rounded-3xl p-6 shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-amber-400 to-orange-500 text-white flex items-center justify-center text-2xl mb-4 group-hover:scale-110 transition shadow-md">
                                <i class="fa-solid {{ $srv->icon }}"></i>
                            </div>
                            @if($srv->stats)
                                <span class="text-[10px] font-black text-orange-800 bg-yellow-200 px-3 py-1 rounded-full border border-yellow-400">
                                    {{ $srv->stats }}
                                </span>
                            @endif
                            <h3 class="text-lg font-bold text-slate-900 mt-3 group-hover:text-orange-600 transition">
                                {{ $srv->title }}
                            </h3>
                            <p class="text-xs text-slate-600 mt-2 leading-relaxed">
                                {{ $srv->subtitle }}
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-100">
                            <a href="{{ route('trust') }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1 group-hover:gap-2 transition-all">
                                <span>{{ __('messages.btn_read_more') }}</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-orange-50/50 border-2 border-dashed border-orange-200 rounded-3xl p-8 text-center text-slate-500 text-xs font-semibold">
                        <i class="fa-solid fa-hand-holding-heart text-3xl text-orange-400 mb-2 block"></i>
                        {{ app()->getLocale() == 'gu' ? 'ટ્રસ્ટ સેવાકીય પ્રકલ્પોની માહિતી એડમિન પેનલમાંથી ઉમેરી શકો છો.' : 'Trust activities will be updated shortly from admin panel.' }}
                    </div>
                @endforelse
            </div>

        </div>
    </section>

    <!-- SECTION 3: FEATURED DARSHAN GALLERY (Centered & Proper Proportions) -->
    @if($featuredGallery->count())
        <section class="py-16 lg:py-24 bg-white border-b border-orange-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Centered Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm inline-block mb-3">
                        {{ __('messages.gallery_badge') }}
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-slate-900 heading-divine">
                        {{ __('messages.nav_gallery') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 font-medium max-w-xl mx-auto">
                        {{ app()->getLocale() == 'gu' ? 'શ્રી ગાત્રાળધામ મંદિર, અલૌકિક શૃંગાર દર્શન અને પાવન મહોત્સવોની મનોહર તસવીરો' : 'Divine Shringar Darshan, Temple Architecture, and Sacred Celebrations of Shree Gatrad Dham' }}
                    </p>
                </div>

                <!-- Centered Uniform Image Grid (3 Columns) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto">
                    @foreach($featuredGallery as $photo)
                        <a href="{{ route('gallery') }}" class="group block bg-white rounded-3xl overflow-hidden border-2 border-orange-200 hover:border-orange-500 shadow-md hover:shadow-2xl transition-all duration-300">
                            <div class="h-72 sm:h-80 w-full overflow-hidden bg-slate-950 relative flex items-center justify-center">
                                <!-- Ambient Blurred Color Backdrop -->
                                <img src="{{ $photo->image_url }}" 
                                     alt="" 
                                     class="absolute inset-0 w-full h-full object-cover blur-xl opacity-40 scale-125 pointer-events-none" 
                                     aria-hidden="true"
                                     onerror="this.style.display='none'">

                                <!-- Full Sharp Uncropped Foreground Image -->
                                <img 
                                    src="{{ $photo->image_url }}" 
                                    alt="{{ $photo->title }}" 
                                    class="relative z-10 max-h-full max-w-full object-contain p-2 group-hover:scale-105 transition-transform duration-500 shadow-2xl"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.src='/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg';"
                                >
                                <div class="absolute inset-0 z-20 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="w-12 h-12 rounded-full bg-white/95 text-orange-600 flex items-center justify-center text-lg shadow-xl transform scale-75 group-hover:scale-100 transition duration-300">
                                        <i class="fa-solid fa-expand"></i>
                                    </span>
                                </div>
                                <span class="absolute top-3 right-3 z-20 text-[10px] font-black uppercase tracking-wider bg-black/70 backdrop-blur-md border border-yellow-400/80 text-yellow-300 px-3 py-1 rounded-full shadow-lg">
                                    {{ ucfirst($photo->category) }}
                                </span>
                            </div>
                            <div class="p-4 bg-gradient-to-b from-white to-orange-50/40 border-t border-orange-100 flex items-center justify-between gap-3">
                                <h3 class="font-bold text-slate-800 text-xs sm:text-sm truncate group-hover:text-orange-600 transition" title="{{ $photo->title }}">
                                    {{ $photo->title }}
                                </h3>
                                <span class="text-orange-600 text-xs font-black flex items-center gap-1 shrink-0 group-hover:translate-x-0.5 transition-transform">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Centered View All Gallery Button -->
                <div class="text-center mt-12">
                    <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2.5 btn-theme-gradient font-black px-8 py-3.5 rounded-2xl text-xs sm:text-sm transition hover:scale-105 shadow-xl">
                        <i class="fa-solid fa-images text-yellow-200"></i>
                        <span>{{ __('messages.btn_view_gallery') }}</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

            </div>
        </section>
    @endif

    <!-- SECTION 4: LATEST NEWS / BLOG (Centered Layout) -->
    @if($latestBlogs->count())
        <section class="py-16 lg:py-24 bg-gradient-to-b from-orange-50/50 to-white border-b border-orange-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Centered Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm inline-block mb-3">
                        {{ __('messages.blog_badge') }}
                    </span>
                    <h2 class="text-2xl sm:text-4xl font-black text-slate-900 heading-divine">
                        {{ __('messages.nav_blog') }}
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 mt-2 font-medium max-w-xl mx-auto">
                        {{ app()->getLocale() == 'gu' ? 'મંદિરના આગામી ઉત્સવો, ધાર્મિક મહોત્સવો અને ટ્રસ્ટ સેવા પ્રકલ્પોના તાજા સમાચાર' : 'Latest updates, upcoming festivals, and charitable mission news from Shree Gatrad Dham' }}
                    </p>
                </div>

                <!-- Centered Blog Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto">
                    @foreach($latestBlogs as $b)
                        <article class="bg-white border-2 border-orange-200 hover:border-orange-500 rounded-3xl overflow-hidden shadow-md hover:shadow-2xl flex flex-col justify-between group transition duration-300">
                            <div>
                                <a href="{{ route('blog.show', $b->slug) }}" class="block h-52 w-full overflow-hidden bg-slate-100 relative">
                                    <img 
                                        src="{{ $b->image_url }}" 
                                        alt="{{ $b->title }}" 
                                        class="w-full h-full object-cover object-center group-hover:scale-105 transition duration-500"
                                        loading="lazy"
                                        onerror="this.onerror=null; this.src='/uploads/sliders/banner_1.jpg';"
                                    >
                                    <span class="absolute top-3 left-3 bg-white/95 backdrop-blur text-orange-800 text-[10px] font-black px-3 py-1 rounded-full border border-orange-300 shadow-sm flex items-center gap-1">
                                        <i class="fa-regular fa-calendar"></i>
                                        <span>{{ $b->published_date ? $b->published_date->format('d M, Y') : '' }}</span>
                                    </span>
                                </a>
                                <div class="p-6">
                                    <h3 class="font-bold text-slate-900 text-base group-hover:text-orange-600 transition leading-snug line-clamp-2">
                                        <a href="{{ route('blog.show', $b->slug) }}">{{ $b->title }}</a>
                                    </h3>
                                    <p class="text-slate-600 text-xs mt-2.5 line-clamp-3 leading-relaxed">{{ $b->excerpt }}</p>
                                </div>
                            </div>
                            <div class="p-6 pt-0">
                                <a href="{{ route('blog.show', $b->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-orange-600 hover:text-orange-700 group-hover:translate-x-1 transition-transform">
                                    <span>{{ __('messages.btn_read_more') }}</span>
                                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Centered View All Blogs Button -->
                <div class="text-center mt-12">
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2.5 btn-theme-gradient font-black px-8 py-3.5 rounded-2xl text-xs sm:text-sm transition hover:scale-105 shadow-xl">
                        <i class="fa-solid fa-newspaper text-yellow-200"></i>
                        <span>{{ __('messages.btn_view_all') }}</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

            </div>
        </section>
    @endif

@endsection
