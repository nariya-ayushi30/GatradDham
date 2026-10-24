@extends('frontend.layouts.master')

@section('title', __('messages.nav_trust') . ' | ' . __('messages.site_title'))

@section('content')

    <!-- Banner Header (Yellow, White, Orange) -->
    <div class="py-14 bg-gradient-to-b from-orange-50 via-amber-50 to-white border-b-2 border-orange-100 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm">
                {{ __('messages.human_service') }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 heading-divine mt-4">
                {{ __('messages.trust_heading') }}
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-medium">
                {{ __('messages.trust_subheading') }}
            </p>
        </div>
    </div>

    <!-- Trust Activities List -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">
        
        @forelse($activities as $index => $act)
            <div class="bg-white border-2 border-orange-200 hover:border-orange-500 rounded-3xl p-6 sm:p-8 shadow-md hover:shadow-2xl flex flex-col {{ $index % 2 == 1 ? 'lg:flex-row-reverse' : 'lg:flex-row' }} items-center gap-8 group transition duration-300">
                
                <!-- Image -->
                <div class="w-full lg:w-1/2 aspect-video rounded-2xl overflow-hidden border-2 border-yellow-400/80 bg-slate-100 shrink-0 shadow-md">
                    <img src="{{ $act->image_url }}" alt="{{ $act->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>

                <!-- Content -->
                <div class="w-full lg:w-1/2 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-400 to-orange-500 text-white flex items-center justify-center text-lg shadow">
                                <i class="fa-solid {{ $act->icon }}"></i>
                            </span>
                            @if($act->stats)
                                <span class="text-[11px] font-black text-orange-800 bg-yellow-200 px-3.5 py-1 rounded-full border border-yellow-400 shadow-sm">
                                    {{ $act->stats }}
                                </span>
                            @endif
                        </div>

                        <h2 class="text-2xl font-black text-slate-900 heading-divine mt-3 group-hover:text-orange-600 transition">
                            {{ $act->title }}
                        </h2>
                        
                        @if($act->subtitle)
                            <p class="text-xs font-bold text-orange-600 mt-1">
                                {{ $act->subtitle }}
                            </p>
                        @endif

                        <p class="text-slate-600 text-xs sm:text-sm mt-4 leading-relaxed font-normal">
                            {{ $act->description }}
                        </p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 flex flex-wrap gap-3">
                        <a href="{{ route('donation') }}" class="btn-theme-gradient font-bold px-5 py-2.5 rounded-xl text-xs flex items-center gap-2">
                            <i class="fa-solid fa-hand-holding-dollar text-yellow-200"></i>
                            <span>{{ __('messages.btn_support_seva') }}</span>
                        </a>
                        <a href="{{ route('contact') }}" class="bg-white hover:bg-orange-50 text-slate-700 border-2 border-orange-200 px-4 py-2.5 rounded-xl text-xs font-bold transition">
                            {{ __('messages.btn_inquire_now') }}
                        </a>
                    </div>
                </div>

            </div>
        @empty
            <div class="bg-white border-2 border-dashed border-orange-200 rounded-3xl p-12 text-center text-slate-500 text-sm font-semibold">
                <i class="fa-solid fa-hand-holding-heart text-4xl text-orange-400 mb-3 block"></i>
                {{ app()->getLocale() == 'gu' ? 'હાલમાં કોઈ ટ્રસ્ટ સેવા પ્રવૃત્તિ નોંધાયેલ નથી. એડમિન પેનલમાંથી ઉમેરી શકો છો.' : 'No trust activities added yet. Add activities from admin panel.' }}
            </div>
        @endforelse

    </div>

@endsection
