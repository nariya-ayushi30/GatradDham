@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
@endphp

@section('title', $isGu ? 'ઇતિહાસ & મહિમા સંચાલન | શ્રી ગાત્રાળ ધામ એડમિન' : 'About Us Management | Shree Gatrad Dham Admin')

@section('content')

    @php
        $initBadge = old($isGu ? 'banner_badge_gu' : 'banner_badge_en', $isGu ? ($about->banner_badge_gu ?: $about->banner_badge_en) : ($about->banner_badge_en ?: $about->banner_badge_gu)) ?: ($isGu ? 'પાવન ગાથા' : 'Sacred Saga');
        $initTitle = old($isGu ? 'banner_title_gu' : 'banner_title_en', $isGu ? ($about->banner_title_gu ?: $about->banner_title_en) : ($about->banner_title_en ?: $about->banner_title_gu)) ?: ($isGu ? 'શ્રી ગાત્રાળ માતાજીનો દિવ્ય મહિમા & પાવન ઇતિહાસ' : 'Divine Mahima & History of Shree Gatrad Mataji');
        $initSub = old($isGu ? 'banner_subtitle_gu' : 'banner_subtitle_en', $isGu ? ($about->banner_subtitle_gu ?: $about->banner_subtitle_en) : ($about->banner_subtitle_en ?: $about->banner_subtitle_gu)) ?: ($isGu ? 'પરમ પૂજ્ય કુળદેવી શ્રી ગાત્રાળ માંની ઉત્પત્તિ, ચમત્કારો અને પાવન તીર્થધામનો ઐતિહાસિક વારસો.' : 'The divine origin, miracles, and sacred heritage of Shree Gatrad Dham.');
        $initSec1Title = old($isGu ? 'sec1_title_gu' : 'sec1_title_en', $isGu ? ($about->sec1_title_gu ?: $about->sec1_title_en) : ($about->sec1_title_en ?: $about->sec1_title_gu)) ?: ($isGu ? '૧. કુળદેવી શ્રી ગાત્રાળ માંની સ્થાપના અને મહિમા' : '1. Divine Glory & Origin of Shree Gatrad Maa');
        $initSec1Content = old($isGu ? 'sec1_content_gu' : 'sec1_content_en', $isGu ? ($about->sec1_content_gu ?: $about->sec1_content_en) : ($about->sec1_content_en ?: $about->sec1_content_gu)) ?: ($isGu ? "શ્રી ગાત્રાળ માં ગુજરાત તથા સમગ્ર દેશમાં વસતા અનેક પરિવારો, પાટીદાર, રાજપૂત, પ્રજાપતિ, સોની તેમજ અન્ય સર્વ સમુદાયોના કુળદેવી તરીકે પૂજાય છે.\n\nમાંના દરબારમાં જે કોઈ શ્રદ્ધાળુ સાચા મનથી પ્રાર્થના કરે છે તેની સઘળી મુશ્કેલીઓ માં હરી લે છે." : "Shree Gatrad Maa is revered as the Kuldevi of countless families across Gujarat and India.\n\nDevotees praying with a pure heart find all obstacles and hardships removed by Maa's grace.");
        $initShlokText = old('shlok_text', $about->shlok_text) ?: "ગાત્રે ગાત્રે વ્યાપિતા યા, રક્ષિણી સર્વ દેહિનામ્ |\nનમામિ વરદાં દેવીં, ગાત્રાળીં શત્રુનાશિનીમ્ ||";
        $initShlokBadge = old($isGu ? 'shlok_badge_gu' : 'shlok_badge_en', $isGu ? ($about->shlok_badge_gu ?: $about->shlok_badge_en) : ($about->shlok_badge_en ?: $about->shlok_badge_gu)) ?: ($isGu ? '— માતાજીનો પવિત્ર સ્તુતિ શ્લોક' : '— Sacred Stuti Hymn');
        $initSec2Title = old($isGu ? 'sec2_title_gu' : 'sec2_title_en', $isGu ? ($about->sec2_title_gu ?: $about->sec2_title_en) : ($about->sec2_title_en ?: $about->sec2_title_gu)) ?: ($isGu ? '૨. પાવન તીર્થધામનો વિકાસ' : '2. Development of the Holy Pilgrimage Center');
        $initSec2Content = old($isGu ? 'sec2_content_gu' : 'sec2_content_en', $isGu ? ($about->sec2_content_gu ?: $about->sec2_content_en) : ($about->sec2_content_en ?: $about->sec2_content_gu)) ?: ($isGu ? "શરૂઆતમાં આ પાવન સ્થાનક પર એક નાની દેરીમાં પૂજા થતી હતી. ભક્તોની અતૂટ શ્રદ્ધાથી આજે અહીં એક વિશાળ મંદિર, અન્નક્ષેત્ર અને ગૌશાળા નિર્માણ પામ્યા છે.\n\nમંદિરના ગર્ભગૃહમાં સ્થાપિત શ્રી ગાત્રાળ માતાજીની દિવ્ય મૂર્તિ જોઈને કોઈપણ દર્શનાર્થી મંત્રમુગ્ધ થઈ જાય છે." : "Initially, worship began at a humble shrine. Through devotees' unwavering devotion, it has flourished into a magnificent temple, free Mahaprasad Annakshetra, and modern Gaushala.\n\nThe sanctum sanctorum houses the resplendent idol of Shree Gatrad Mataji.");
    @endphp

    <div x-data="{
        bannerBadge: @js($initBadge),
        bannerTitle: @js($initTitle),
        bannerSub: @js($initSub),
        sec1Title: @js($initSec1Title),
        sec1Content: @js($initSec1Content),
        shlokText: @js($initShlokText),
        shlokBadge: @js($initShlokBadge),
        sec2Title: @js($initSec2Title),
        sec2Content: @js($initSec2Content)
    }" class="space-y-6">

        <!-- Top Header Card -->
        <div class="bg-gradient-to-r from-amber-500/10 via-orange-500/10 to-yellow-500/10 border-2 border-orange-200 rounded-3xl p-6 sm:p-7 shadow-sm bg-white relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-44 h-44 rounded-full bg-orange-300/20 blur-2xl pointer-events-none"></div>

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 relative z-10">
                <div>
                    <div class="flex items-center gap-2 mb-1.5">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-orange-100 text-orange-800 border border-orange-200">
                            <i class="fa-solid fa-om text-orange-600"></i>
                            <span>{{ $isGu ? 'પેજ કન્ટેન્ટ મેનેજમેન્ટ' : 'PAGE CONTENT MANAGER' }}</span>
                        </span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-50 text-amber-900 border border-amber-200">
                            <i class="fa-solid fa-language text-amber-600"></i>
                            <span>{{ $isGu ? 'ગુજરાતી મોડ સક્રિય' : 'English Mode Active' }}</span>
                        </span>
                    </div>

                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight flex items-center gap-2.5">
                        <i class="fa-solid fa-scroll text-orange-600 text-2xl"></i>
                        <span>{{ $isGu ? 'ઇતિહાસ & મહિમા પેજ સંચાલન' : 'About Us & History Management' }}</span>
                    </h1>
                    <p class="text-xs text-slate-600 mt-1 max-w-2xl font-medium">
                        {{ $isGu ? 'વેબસાઇટના /about પેજ પર દર્શાવવા માટેનું તમામ લખાણ અહીંથી લાઈવ એડિટ કરો. ડાબી બાજુ લખો અને જમણી બાજુ તાત્કાલિક લાઈવ પ્રિવ્યુ જુઓ.' : 'Dynamically customize public /about page content. Edit on the left and see the real-time live preview on the right.' }}
                    </p>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    <a href="{{ route('about') }}" target="_blank" 
                       class="px-5 py-2.5 rounded-2xl bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 text-white text-xs font-black flex items-center gap-2 transition shadow-md hover:shadow-lg">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        <span>{{ $isGu ? 'લાઈવ /about પેજ જુઓ' : 'View Live /about Page' }}</span>
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border-2 border-emerald-300 text-xs font-bold text-emerald-800 flex items-center gap-2.5 shadow-sm">
                <div class="w-7 h-7 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-circle-check text-sm"></i>
                </div>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="p-4 rounded-2xl bg-rose-50 border-2 border-rose-300 text-xs font-bold text-rose-800 space-y-1 shadow-sm">
                @foreach($errors->all() as $err)
                    <p><i class="fa-solid fa-triangle-exclamation mr-1.5 text-rose-600"></i> {{ $err }}</p>
                @endforeach
            </div>
        @endif

        <!-- 2-Column Responsive Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-7 items-start">
            
            <!-- Left Column: The Editor Form (Col 7) -->
            <div class="lg:col-span-7 space-y-6">
                
                <form action="{{ route('admin.about.update') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- CARD 1: HERO BANNER -->
                    <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 sm:p-7 shadow-sm hover:shadow-md transition">
                        <div class="flex items-center justify-between border-b border-orange-100 pb-4 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-400 to-orange-500 text-white flex items-center justify-center text-sm font-black shadow-sm">
                                    1
                                </div>
                                <div>
                                    <h2 class="text-base font-black text-slate-900 flex items-center gap-2">
                                        <span>{{ $isGu ? 'મુખ્ય હેડર & બેનર' : 'Header & Hero Banner' }}</span>
                                    </h2>
                                    <p class="text-[11px] text-slate-500 font-semibold">{{ $isGu ? 'પેજની સૌથી ઉપર દેખાતું મુખ્ય શીર્ષક અને સબટાઇટલ' : 'Main page banner title and introductory subtitle' }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-3 py-1 rounded-full bg-orange-50 text-orange-700 border border-orange-200">
                                {{ $isGu ? 'ટોચનો ભાગ' : 'Top Hero' }}
                            </span>
                        </div>

                        <div class="space-y-4 text-xs">
                            <!-- Badge -->
                            <div>
                                <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-tag text-orange-500"></i>
                                    <span>{{ $isGu ? 'બેનર નાનો બેજ (Pill Tag)' : 'Banner Pill Badge' }}</span>
                                </label>
                                <input type="text" 
                                       name="{{ $isGu ? 'banner_badge_gu' : 'banner_badge_en' }}" 
                                       x-model="bannerBadge"
                                       placeholder="{{ $isGu ? 'દા.ત. પાવન ગાથા' : 'e.g. Sacred Saga' }}"
                                       class="w-full bg-slate-50/50 hover:bg-white focus:bg-white border-2 border-slate-200 focus:border-orange-500 rounded-xl px-4 py-2.5 text-slate-900 font-bold focus:outline-none transition shadow-sm">
                            </div>

                            <!-- Main Title -->
                            <div>
                                <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-heading text-orange-500"></i>
                                    <span>{{ $isGu ? 'મુખ્ય શીર્ષક (Main Heading)*' : 'Main Page Title*' }}</span>
                                </label>
                                <input type="text" 
                                       name="{{ $isGu ? 'banner_title_gu' : 'banner_title_en' }}" 
                                       x-model="bannerTitle"
                                       required 
                                       placeholder="{{ $isGu ? 'દા.ત. શ્રી ગાત્રાળ માતાજીનો દિવ્ય મહિમા & પાવન ઇતિહાસ' : 'e.g. Divine Mahima & History of Shree Gatrad Mataji' }}"
                                       class="w-full bg-white border-2 border-orange-200 focus:border-orange-500 rounded-xl px-4 py-2.5 text-slate-900 font-black text-sm focus:outline-none transition shadow-sm">
                            </div>

                            <!-- Subtitle -->
                            <div>
                                <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-align-left text-orange-500"></i>
                                    <span>{{ $isGu ? 'સબટાઇટલ (Subtitle Description)' : 'Subtitle Description' }}</span>
                                </label>
                                <textarea name="{{ $isGu ? 'banner_subtitle_gu' : 'banner_subtitle_en' }}" 
                                          x-model="bannerSub"
                                          rows="2" 
                                          placeholder="{{ $isGu ? 'પરમ પૂજ્ય કુળદેવી શ્રી ગાત્રાળ માંની ઉત્પત્તિ...' : 'The divine origin, miracles, and sacred heritage...' }}"
                                          class="w-full bg-slate-50/50 hover:bg-white focus:bg-white border-2 border-slate-200 focus:border-orange-500 rounded-xl px-4 py-2.5 text-slate-900 font-medium focus:outline-none transition leading-relaxed shadow-sm"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 2: SECTION 1 (HISTORY & PRAGATYA) -->
                    <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 sm:p-7 shadow-sm hover:shadow-md transition">
                        <div class="flex items-center justify-between border-b border-orange-100 pb-4 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg font-black shadow-sm">
                                    🪔
                                </div>
                                <div>
                                    <h2 class="text-base font-black text-slate-900 flex items-center gap-2">
                                        <span>{{ $isGu ? 'સેક્શન ૧: પ્રાગટ્ય કથા & દિવ્ય મહિમા' : 'Section 1: Divine Origin & Glory' }}</span>
                                    </h2>
                                    <p class="text-[11px] text-slate-500 font-semibold">{{ $isGu ? 'માતાજીનો પ્રાગટ્ય ઈતિહાસ અને કુળદેવી તરીકેનો મહિમા' : 'Temple origin history and divine manifestation story' }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-3 py-1 rounded-full bg-amber-50 text-amber-800 border border-amber-200">
                                {{ $isGu ? 'પ્રથમ પ્રકરણ' : 'Part 1' }}
                            </span>
                        </div>

                        <div class="space-y-4 text-xs">
                            <!-- Section 1 Title -->
                            <div>
                                <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-heading text-orange-500"></i>
                                    <span>{{ $isGu ? 'સેક્શન ૧ શીર્ષક*' : 'Section 1 Heading*' }}</span>
                                </label>
                                <input type="text" 
                                       name="{{ $isGu ? 'sec1_title_gu' : 'sec1_title_en' }}" 
                                       x-model="sec1Title"
                                       required
                                       placeholder="{{ $isGu ? 'દા.ત. ૧. કુળદેવી શ્રી ગાત્રાળ માંની સ્થાપના અને મહિમા' : 'e.g. 1. Divine Glory & Origin of Shree Gatrad Maa' }}"
                                       class="w-full bg-white border-2 border-orange-200 focus:border-orange-500 rounded-xl px-4 py-2.5 text-slate-900 font-bold focus:outline-none transition shadow-sm">
                            </div>

                            <!-- Section 1 Content -->
                            <div>
                                <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-paragraph text-orange-500"></i>
                                    <span>{{ $isGu ? 'પ્રાગટ્ય કથા & મહિમા વિગત (પેરાગ્રાફ્સ)*' : 'Story Content & History (Paragraphs)*' }}</span>
                                </label>
                                <textarea name="{{ $isGu ? 'sec1_content_gu' : 'sec1_content_en' }}" 
                                          x-model="sec1Content"
                                          rows="6" 
                                          required 
                                          placeholder="{{ $isGu ? 'સંપૂર્ણ પ્રાગટ્ય કથા અને મહિમા અહીં લખો...' : 'Write detailed history and significance paragraphs...' }}"
                                          class="w-full bg-slate-50/50 hover:bg-white focus:bg-white border-2 border-slate-200 focus:border-orange-500 rounded-xl p-4 text-slate-900 font-normal leading-relaxed focus:outline-none transition shadow-sm"></textarea>
                                <span class="text-[11px] text-slate-400 mt-1 block">
                                    {{ $isGu ? '💡 ટિપ: બે પેરાગ્રાફ વચ્ચે એક ખાલી લાઇન છોડો જેથી સુંદર રીતે ફોર્મેટ થશે.' : '💡 Tip: Leave a blank line between paragraphs to separate them cleanly.' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- CARD 3: SHLOKA / STUTI BOX -->
                    <div class="bg-gradient-to-r from-amber-50/50 via-yellow-50/40 to-orange-50/50 border-2 border-yellow-300 rounded-3xl p-6 sm:p-7 shadow-sm hover:shadow-md transition">
                        <div class="flex items-center justify-between border-b border-yellow-200/80 pb-4 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-yellow-400/30 text-amber-900 flex items-center justify-center text-lg font-black shadow-sm border border-yellow-400/50">
                                    🕉️
                                </div>
                                <div>
                                    <h2 class="text-base font-black text-amber-950 flex items-center gap-2">
                                        <span>{{ $isGu ? 'પાવન સ્તુતિ શ્લોક & મંત્ર બોક્સ' : 'Sacred Shloka / Stuti Box' }}</span>
                                    </h2>
                                    <p class="text-[11px] text-amber-800 font-semibold">{{ $isGu ? 'પેજની મધ્યમાં ગોલ્ડન હાઇલાઇટ બોક્સમાં દર્શાવાતો શ્લોક' : 'Golden highlighted sacred hymn box displayed in the center' }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-3 py-1 rounded-full bg-yellow-200 text-yellow-900 border border-yellow-400">
                                {{ $isGu ? 'સ્તુતિ હાઈલાઈટ' : 'Featured Shloka' }}
                            </span>
                        </div>

                        <div class="space-y-4 text-xs">
                            <div>
                                <label class="block font-bold text-amber-950 mb-1.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-quote-left text-amber-600"></i>
                                    <span>{{ $isGu ? 'મૂળ સંસ્કૃત / ગુજરાતી શ્લોક મંત્ર*' : 'Sacred Shloka / Hymn Text*' }}</span>
                                </label>
                                <textarea name="shlok_text" 
                                          x-model="shlokText"
                                          rows="3" 
                                          required 
                                          placeholder="ગાત્રે ગાત્રે વ્યાપિતા યા, રક્ષિણી સર્વ દેહિનામ્..."
                                          class="w-full bg-white border-2 border-yellow-300 focus:border-orange-500 rounded-xl p-3.5 font-bold text-orange-950 focus:outline-none transition leading-relaxed shadow-sm"></textarea>
                            </div>

                            <div>
                                <label class="block font-bold text-amber-950 mb-1.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-ribbon text-amber-600"></i>
                                    <span>{{ $isGu ? 'શ્લોક લેબલ / સબટાઇટલ' : 'Shloka Badge / Tagline' }}</span>
                                </label>
                                <input type="text" 
                                       name="{{ $isGu ? 'shlok_badge_gu' : 'shlok_badge_en' }}" 
                                       x-model="shlokBadge"
                                       placeholder="{{ $isGu ? '— માતાજીનો પવિત્ર સ્તુતિ શ્લોક' : '— Sacred Stuti Hymn' }}"
                                       class="w-full bg-white border-2 border-yellow-200 focus:border-orange-500 rounded-xl px-4 py-2.5 text-slate-900 font-bold focus:outline-none transition shadow-sm">
                            </div>
                        </div>
                    </div>

                    <!-- CARD 4: SECTION 2 (PILGRIMAGE DEVELOPMENT & TRUST) -->
                    <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 sm:p-7 shadow-sm hover:shadow-md transition">
                        <div class="flex items-center justify-between border-b border-orange-100 pb-4 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg font-black shadow-sm">
                                    🚩
                                </div>
                                <div>
                                    <h2 class="text-base font-black text-slate-900 flex items-center gap-2">
                                        <span>{{ $isGu ? 'સેક્શન ૨: તીર્થધામ નિર્માણ & ટ્રસ્ટ પ્રવૃત્તિઓ' : 'Section 2: Temple Development & Trust' }}</span>
                                    </h2>
                                    <p class="text-[11px] text-slate-500 font-semibold">{{ $isGu ? 'નાની દેરીથી ભવ્ય મંદિર સુધીનો વિકાસ અને સેવાકીય કાર્યો' : 'History of shrine development, Annakshetra, and modern temple' }}</p>
                                </div>
                            </div>
                            <span class="text-[10px] font-bold px-3 py-1 rounded-full bg-orange-50 text-orange-700 border border-orange-200">
                                {{ $isGu ? 'બીજું પ્રકરણ' : 'Part 2' }}
                            </span>
                        </div>

                        <div class="space-y-4 text-xs">
                            <!-- Section 2 Title -->
                            <div>
                                <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-heading text-orange-500"></i>
                                    <span>{{ $isGu ? 'સેક્શન ૨ શીર્ષક*' : 'Section 2 Heading*' }}</span>
                                </label>
                                <input type="text" 
                                       name="{{ $isGu ? 'sec2_title_gu' : 'sec2_title_en' }}" 
                                       x-model="sec2Title"
                                       required
                                       placeholder="{{ $isGu ? 'દા.ત. ૨. પાવન તીર્થધામનો વિકાસ' : 'e.g. 2. Development of the Holy Pilgrimage Center' }}"
                                       class="w-full bg-white border-2 border-orange-200 focus:border-orange-500 rounded-xl px-4 py-2.5 text-slate-900 font-bold focus:outline-none transition shadow-sm">
                            </div>

                            <!-- Section 2 Content -->
                            <div>
                                <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                                    <i class="fa-solid fa-paragraph text-orange-500"></i>
                                    <span>{{ $isGu ? 'તીર્થ વિકાસ & ટ્રસ્ટ સેવા વિગત (પેરાગ્રાફ્સ)*' : 'Pilgrimage Development & Trust Content*' }}</span>
                                </label>
                                <textarea name="{{ $isGu ? 'sec2_content_gu' : 'sec2_content_en' }}" 
                                          x-model="sec2Content"
                                          rows="6" 
                                          required 
                                          placeholder="{{ $isGu ? 'મંદિર વિકાસ અને અન્નક્ષેત્ર વિશેની વિગત અહીં લખો...' : 'Write pilgrimage development and trust activities here...' }}"
                                          class="w-full bg-slate-50/50 hover:bg-white focus:bg-white border-2 border-slate-200 focus:border-orange-500 rounded-xl p-4 text-slate-900 font-normal leading-relaxed focus:outline-none transition shadow-sm"></textarea>
                                <span class="text-[11px] text-slate-400 mt-1 block">
                                    {{ $isGu ? '💡 ટિપ: બે પેરાગ્રાફ વચ્ચે એક ખાલી લાઇન છોડો.' : '💡 Tip: Leave a blank line between paragraphs.' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="sticky bottom-4 z-20 pt-2">
                        <button type="submit" 
                                class="w-full py-4 rounded-2xl bg-gradient-to-r from-amber-400 via-orange-500 to-orange-600 hover:from-amber-500 hover:to-orange-700 text-white font-black text-sm shadow-xl hover:shadow-2xl transition flex items-center justify-center gap-2.5 border-2 border-yellow-300 transform active:scale-[0.99]">
                            <i class="fa-solid fa-floppy-disk text-base"></i>
                            <span>{{ $isGu ? 'બધા ફેરફારો સેવ કરો (Save Changes)' : 'Save All Changes to /about' }}</span>
                        </button>
                    </div>

                </form>

            </div>

            <!-- Right Column: Sticky Live Interactive Mockup Preview (Col 5) -->
            <div class="lg:col-span-5 sticky top-6 space-y-4">
                
                <div class="bg-white border-2 border-orange-200 rounded-3xl p-5 shadow-xl overflow-hidden">
                    
                    <!-- Preview Bar Header -->
                    <div class="flex items-center justify-between pb-3.5 border-b border-orange-100 mb-4">
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider">
                                {{ $isGu ? 'લાઈવ પૂર્વાવલોકન (Live Preview)' : 'Live Page Preview' }}
                            </h3>
                        </div>

                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-800 border border-emerald-300">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>{{ $isGu ? 'લાઈવ પ્રિવ્યુ' : 'Interactive' }}</span>
                        </span>
                    </div>

                    <!-- Mini Browser Window Shell -->
                    <div class="rounded-2xl border-2 border-slate-200 bg-slate-50 overflow-hidden shadow-inner">
                        
                        <!-- Mini Browser Titlebar -->
                        <div class="bg-slate-200/70 px-3 py-2 border-b border-slate-200 flex items-center justify-between">
                            <div class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-400 inline-block"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-yellow-400 inline-block"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 inline-block"></span>
                            </div>
                            <span class="text-[10px] text-slate-600 font-mono font-bold truncate max-w-[170px]">
                                gatraddham.org/about
                            </span>
                            <i class="fa-solid fa-rotate-right text-[10px] text-slate-400"></i>
                        </div>

                        <!-- Mini Content Preview Area (Mirrors Frontend /about Exactly) -->
                        <div class="p-3.5 sm:p-4 bg-[#faf8f5] max-h-[640px] overflow-y-auto space-y-4 text-left">
                            
                            <!-- Mini Hero Header -->
                            <div class="py-5 px-3 bg-gradient-to-b from-orange-50 via-amber-50 to-white rounded-2xl border border-orange-100 text-center">
                                <span class="text-[9px] font-black text-orange-800 uppercase tracking-widest bg-yellow-200 px-2.5 py-0.5 rounded-full border border-yellow-400 inline-block shadow-xs"
                                      x-text="bannerBadge || '{{ $isGu ? 'પાવન ગાથા' : 'Sacred Saga' }}'">
                                </span>
                                <h4 class="text-sm sm:text-base font-black text-slate-900 heading-divine mt-2 leading-tight"
                                    x-text="bannerTitle || '{{ $isGu ? 'શ્રી ગાત્રાળ માતાજીનો દિવ્ય મહિમા' : 'Divine Mahima' }}'">
                                </h4>
                                <p class="text-[10px] text-slate-600 mt-1.5 leading-relaxed font-medium line-clamp-2"
                                   x-text="bannerSub || '{{ $isGu ? 'પરમ પૂજ્ય કુળદેવી...' : 'The divine origin...' }}'">
                                </p>
                            </div>

                            <!-- Mini Unified White Card (Exact Same Styling as Frontend) -->
                            <div class="bg-white border-2 border-orange-200 rounded-2xl p-4 shadow-md space-y-4 text-xs">
                                
                                <!-- Mini Section 1 -->
                                <div>
                                    <h5 class="text-xs font-bold text-slate-900 heading-divine flex items-center gap-1.5">
                                        <span class="text-sm">🪔</span>
                                        <span x-text="sec1Title || '{{ $isGu ? '૧. કુળદેવી શ્રી ગાત્રાળ માંની સ્થાપના અને મહિમા' : '1. Divine Glory & Origin' }}'"></span>
                                    </h5>
                                    <div class="mt-2 text-slate-600 text-[10px] leading-relaxed line-clamp-4 whitespace-pre-line"
                                         x-text="sec1Content || '{{ $isGu ? 'શ્રી ગાત્રાળ માં સમગ્ર ગુજરાતમાં...' : 'Shree Gatrad Maa is revered...' }}'">
                                    </div>
                                </div>

                                <!-- Mini Stuti Box -->
                                <div class="p-3 rounded-xl bg-gradient-to-r from-orange-50 via-yellow-50 to-orange-50 border border-yellow-400 text-center shadow-xs">
                                    <p class="text-[11px] font-black text-orange-900 heading-divine leading-snug whitespace-pre-line"
                                       x-text="shlokText || 'ગાત્રે ગાત્રે વ્યાપિતા યા, રક્ષિણી સર્વ દેહિનામ્...'">
                                    </p>
                                    <span class="text-[9px] text-orange-700 mt-1 block font-bold"
                                          x-text="shlokBadge || '— માતાજીનો પવિત્ર સ્તુતિ શ્લોક'">
                                    </span>
                                </div>

                                <!-- Mini Section 2 -->
                                <div>
                                    <h5 class="text-xs font-bold text-slate-900 heading-divine flex items-center gap-1.5">
                                        <span class="text-sm">🚩</span>
                                        <span x-text="sec2Title || '{{ $isGu ? '૨. પાવન તીર્થધામનો વિકાસ' : '2. Development of Pilgrimage' }}'"></span>
                                    </h5>
                                    <div class="mt-2 text-slate-600 text-[10px] leading-relaxed line-clamp-4 whitespace-pre-line"
                                         x-text="sec2Content || '{{ $isGu ? 'શરૂઆતમાં આ પાવન સ્થાનક પર...' : 'Initially, worship began...' }}'">
                                    </div>
                                </div>

                                <!-- Mini Footer Buttons -->
                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                                    <span class="btn-theme-gradient font-bold px-2.5 py-1 rounded-lg text-[9px] flex items-center gap-1">
                                        <i class="fa-solid fa-bell text-[8px] text-yellow-200"></i>
                                        <span>{{ $isGu ? 'આરતી સમયપત્રક' : 'Aarti Schedule' }}</span>
                                    </span>
                                    <span class="text-orange-600 font-bold text-[9px] flex items-center gap-1">
                                        <span>{{ $isGu ? 'દાન આપો' : 'Donate' }}</span>
                                        <i class="fa-solid fa-arrow-right text-[8px]"></i>
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Bottom Note -->
                    <div class="mt-3.5 p-3 rounded-xl bg-orange-50 border border-orange-200 text-[11px] text-orange-900 font-semibold flex items-center gap-2">
                        <i class="fa-solid fa-sparkles text-amber-600 shrink-0"></i>
                        <span>{{ $isGu ? 'ડાબી બાજુ કોઈપણ લખાણ બદલશો એટલે તરત આ પ્રિવ્યુમાં અપડેટ થઈ જશે!' : 'Type in the form on the left to see live real-time preview updates here!' }}</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
