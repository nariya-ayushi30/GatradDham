@extends('frontend.layouts.master')

@php
    $about = $about ?? \App\Models\AboutPage::firstOrNew(['id' => 1]);
@endphp

@section('title', ($about->getLocalized('banner_title') ?: __('messages.about_title')) . ' | ' . __('messages.site_title'))

@section('content')

    <!-- Banner Header (Yellow, White, Orange) -->
    <div class="py-14 bg-gradient-to-b from-orange-50 via-amber-50 to-white border-b-2 border-orange-100 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm">
                {{ $about->getLocalized('banner_badge') ?: __('messages.about_badge') }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 heading-divine mt-4">
                {{ $about->getLocalized('banner_title') ?: __('messages.about_title') }}
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-medium">
                {{ $about->getLocalized('banner_subtitle') ?: __('messages.about_subtitle') }}
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 sm:p-10 shadow-xl space-y-8">
            
            <!-- Section 1 -->
            <div>
                <h2 class="text-2xl font-bold text-slate-900 heading-divine flex items-center gap-3">
                    <span class="text-2xl text-orange-600">🪔</span>
                    <span>{{ $about->getLocalized('sec1_title') ?: __('messages.about_sec1_title') }}</span>
                </h2>
                <div class="mt-4 text-slate-700 text-sm sm:text-base leading-relaxed space-y-3 font-normal">
                    @if($sec1 = $about->getLocalized('sec1_content'))
                        @foreach(explode("\n\n", str_replace("\r\n", "\n", $sec1)) as $p)
                            @if(trim($p))
                                <p>{{ trim($p) }}</p>
                            @endif
                        @endforeach
                    @else
                        <p>{{ __('messages.about_sec1_p1') }}</p>
                        <p>{{ __('messages.about_sec1_p2') }}</p>
                    @endif
                </div>
            </div>

            <!-- Stuti Box (Yellow, White, Orange) -->
            <div class="p-6 rounded-2xl bg-gradient-to-r from-orange-50 via-yellow-50 to-orange-50 border-2 border-yellow-400 text-center my-6 shadow-sm">
                <p class="text-base sm:text-lg font-black text-orange-800 heading-divine">
                    {!! $about->shlok_text ? nl2br(e($about->shlok_text)) : __('messages.about_shlok') !!}
                </p>
                <span class="text-xs text-orange-700 mt-2 block font-bold">
                    {{ $about->getLocalized('shlok_badge') ?: __('messages.about_shlok_badge') }}
                </span>
            </div>

            <!-- Section 2 -->
            <div>
                <h2 class="text-2xl font-bold text-slate-900 heading-divine flex items-center gap-3">
                    <span class="text-2xl text-orange-600">🚩</span>
                    <span>{{ $about->getLocalized('sec2_title') ?: __('messages.about_sec2_title') }}</span>
                </h2>
                <div class="mt-4 text-slate-700 text-sm sm:text-base leading-relaxed space-y-3 font-normal">
                    @if($sec2 = $about->getLocalized('sec2_content'))
                        @foreach(explode("\n\n", str_replace("\r\n", "\n", $sec2)) as $p)
                            @if(trim($p))
                                <p>{{ trim($p) }}</p>
                            @endif
                        @endforeach
                    @else
                        <p>{{ __('messages.about_sec2_p1') }}</p>
                        <p>{{ __('messages.about_sec2_p2') }}</p>
                    @endif
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex flex-wrap gap-4 items-center justify-between">
                <a href="{{ route('home') }}#aarti-schedule" class="btn-theme-gradient font-bold px-6 py-3 rounded-xl text-sm">
                    <i class="fa-solid fa-bell text-yellow-200 mr-1"></i> {{ __('messages.btn_view_aarti') }}
                </a>
                <a href="{{ route('donation') }}" class="text-orange-600 hover:text-orange-700 text-sm font-bold flex items-center gap-2">
                    <span>{{ __('messages.btn_donate_annakshetra') }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>

    </div>

@endsection
