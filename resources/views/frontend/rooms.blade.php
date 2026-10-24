@extends('frontend.layouts.master')

@section('title', __('messages.room_title') . ' | ' . __('messages.site_title'))

@section('content')

    <!-- Banner Header (Yellow, White, Orange) -->
    <div class="py-14 bg-gradient-to-b from-orange-50 via-amber-50 to-white border-b-2 border-orange-100 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm">
                {{ __('messages.room_badge') }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 heading-divine mt-4">
                {{ __('messages.room_title') }}
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-medium">
                {{ __('messages.room_subtitle') }}
            </p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Room Types Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-14">
            @foreach($rooms as $room)
                <div class="bg-white border-2 border-orange-200 hover:border-orange-500 rounded-3xl p-6 shadow-md hover:shadow-2xl flex flex-col justify-between transition group">
                    <div>
                        <span class="text-[10px] font-black text-orange-800 bg-yellow-200 px-3 py-1 rounded-full border border-yellow-400">
                            {{ $room['tag'] }}
                        </span>
                        <h3 class="text-lg font-black text-slate-900 mt-3 group-hover:text-orange-600 transition">{{ $room['type'] }}</h3>
                        <div class="text-xs text-orange-600 font-bold mt-1">{{ __('messages.room_capacity') }} {{ $room['capacity'] }}</div>
                        
                        <ul class="mt-4 space-y-2 text-xs text-slate-600 font-medium">
                            @foreach($room['features'] as $f)
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-600 text-xs"></i>
                                    <span>{{ $f }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 text-[11px] text-slate-500 font-semibold">
                        {{ __('messages.room_contrib') }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Booking Inquiry Form -->
        <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 sm:p-10 shadow-2xl max-w-3xl mx-auto">
            <h2 class="text-xl font-black text-slate-900 heading-divine mb-2 flex items-center gap-2">
                <i class="fa-solid fa-hotel text-orange-600"></i>
                <span>{{ __('messages.room_form_title') }}</span>
            </h2>
            <p class="text-xs text-slate-600 mb-6 font-medium">{{ __('messages.room_form_sub') }}</p>

            <form action="{{ route('rooms.submit') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.room_name_label') }}</label>
                        <input type="text" name="guest_name" required placeholder="{{ __('messages.room_name_placeholder') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.room_phone_label') }}</label>
                        <input type="tel" name="phone" required placeholder="98XXXXXXXX" class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.room_city_label') }}</label>
                        <input type="text" name="city" required placeholder="{{ __('messages.room_city_placeholder') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.room_type_label') }}</label>
                        <select name="room_type" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-800 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            <option value="Deluxe AC">{{ __('messages.room_type_deluxe') }}</option>
                            <option value="Standard Non-AC">{{ __('messages.room_type_standard') }}</option>
                            <option value="Group Hall">{{ __('messages.room_type_hall') }}</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.room_date_label') }}</label>
                        <input type="date" name="check_in" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.room_guests_label') }}</label>
                        <input type="number" name="guests_count" min="1" max="50" value="2" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.room_note_label') }}</label>
                    <textarea name="notes" rows="2" placeholder="{{ __('messages.room_note_placeholder') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm"></textarea>
                </div>

                <button type="submit" class="w-full btn-theme-gradient font-black py-4 rounded-xl text-base shadow-xl flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane text-yellow-200"></i>
                    <span>{{ __('messages.room_submit_btn') }}</span>
                </button>
            </form>
        </div>

    </div>

@endsection
