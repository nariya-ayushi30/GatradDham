@extends('frontend.layouts.master')

@section('title', __('messages.contact_title') . ' | ' . __('messages.site_title'))

@section('content')

    <!-- Banner Header (Yellow, White, Orange) -->
    <div class="py-14 bg-gradient-to-b from-orange-50 via-amber-50 to-white border-b-2 border-orange-100 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm">
                {{ __('messages.contact_badge') }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 heading-divine mt-4">
                {{ __('messages.contact_title') }}
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-medium">
                {{ __('messages.contact_subtitle') }}
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            <!-- Left Info: Routes & Contact -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- Office Contact (White & Orange) -->
                <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-xl">
                    <h2 class="text-base font-black text-slate-900 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-phone text-orange-600"></i>
                        <span>{{ __('messages.contact_office_title') }}</span>
                    </h2>
                    
                    <ul class="space-y-3.5 text-xs text-slate-700">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-orange-600 mt-1 text-sm"></i>
                            <div>
                                <strong class="text-slate-900 block font-bold">{{ __('messages.contact_addr_label') }}</strong>
                                <span>{{ __('messages.contact_addr_val') }}</span>
                            </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-orange-600 text-sm"></i>
                            <div>
                                <strong class="text-slate-900 block font-bold">{{ __('messages.contact_phone_label') }}</strong>
                                <span>+91 98765 43210 / +91 98250 12345</span>
                            </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-envelope text-orange-600 text-sm"></i>
                            <div>
                                <strong class="text-slate-900 block font-bold">{{ __('messages.contact_email_label') }}</strong>
                                <span>trust@gatraddham.org</span>
                            </div>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-brands fa-whatsapp text-emerald-600 text-base"></i>
                            <div>
                                <strong class="text-emerald-700 block font-bold">{{ __('messages.contact_whatsapp_label') }}</strong>
                                <span>+91 98765 43210</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- How to Reach Cards -->
                <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-xl space-y-4">
                    <h3 class="text-sm font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-route text-orange-600"></i>
                        <span>{{ __('messages.contact_routes_title') }}</span>
                    </h3>

                    <div class="p-4 rounded-2xl bg-orange-50/60 border border-orange-200">
                        <div class="flex items-center gap-2 text-orange-800 text-xs font-black">
                            <i class="fa-solid fa-bus text-orange-600"></i>
                            <span>{{ __('messages.contact_road_title') }}</span>
                        </div>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            {{ __('messages.contact_road_desc') }}
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-orange-50/60 border border-orange-200">
                        <div class="flex items-center gap-2 text-orange-800 text-xs font-black">
                            <i class="fa-solid fa-train text-orange-600"></i>
                            <span>{{ __('messages.contact_train_title') }}</span>
                        </div>
                        <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                            {{ __('messages.contact_train_desc') }}
                        </p>
                    </div>
                </div>

            </div>

            <!-- Right: Contact Message Form -->
            <div class="lg:col-span-7">
                <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 sm:p-8 shadow-xl">
                    <h2 class="text-xl font-black text-slate-900 heading-divine mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-envelope-open-text text-orange-600"></i>
                        <span>{{ __('messages.contact_form_title') }}</span>
                    </h2>
                    <p class="text-xs text-slate-600 mb-6 font-medium">{{ __('messages.contact_form_sub') }}</p>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.contact_name') }}</label>
                            <input type="text" name="name" required placeholder="{{ __('messages.contact_name_placeholder') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.contact_phone') }}</label>
                                <input type="tel" name="phone" required placeholder="98XXXXXXXX" class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.contact_subject') }}</label>
                                <input type="text" name="subject" placeholder="{{ app()->getLocale() == 'gu' ? 'દા.ત. દર્શન પૂજા માહિતી' : 'e.g. Darshan / Yatra inquiry' }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.contact_message') }}</label>
                            <textarea name="message" rows="4" required placeholder="{{ __('messages.contact_message_placeholder') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm"></textarea>
                        </div>

                        <button type="submit" class="w-full btn-theme-gradient font-black py-4 rounded-xl text-base shadow-xl flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane text-yellow-200"></i>
                            <span>{{ __('messages.contact_send') }}</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>

@endsection
