<footer class="bg-gradient-to-b from-orange-700 via-orange-800 to-amber-950 text-white text-sm mt-20 relative overflow-hidden border-t-4 border-yellow-400">
    
    <!-- Top Yellow & Gold Decorative Border -->
    <div class="h-2 bg-gradient-to-r from-yellow-300 via-amber-400 to-yellow-300"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Col 1: About Temple -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-white text-orange-600 flex items-center justify-center font-black text-2xl shadow-lg border-2 border-yellow-300">
                        🪔
                    </div>
                    <div>
                        <span class="text-lg font-black text-white heading-divine block leading-tight">
                            {{ __('messages.site_title') }}
                        </span>
                        <span class="text-[10px] text-yellow-300 uppercase font-black tracking-wider">
                            {{ __('messages.site_subtitle') }}
                        </span>
                    </div>
                </div>
                <p class="text-xs text-orange-100/90 leading-relaxed mb-4">
                    {{ __('messages.footer_about') }}
                </p>
                <div class="p-3.5 rounded-2xl bg-white/10 border border-yellow-400/40 text-xs text-yellow-200">
                    <i class="fa-solid fa-certificate text-yellow-300 mr-1.5 text-sm"></i>
                    {{ __('messages.tax_benefit') }}
                </div>
            </div>

            <!-- Col 2: Navigation Links -->
            <div>
                <h4 class="text-yellow-300 font-extrabold text-sm mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span> {{ __('messages.footer_quick_links') }}
                </h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ route('home') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-white/90"><i class="fa-solid fa-angle-right text-yellow-300 text-[10px]"></i> {{ __('messages.nav_home') }}</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-white/90"><i class="fa-solid fa-angle-right text-yellow-300 text-[10px]"></i> {{ __('messages.nav_about') }}</a></li>
                    <li><a href="{{ route('committee.trust') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-white/90"><i class="fa-solid fa-angle-right text-yellow-300 text-[10px]"></i> {{ __('messages.nav_committee') }}</a></li>
                    <li><a href="{{ route('committee.gam') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-white/90"><i class="fa-solid fa-angle-right text-yellow-300 text-[10px]"></i> {{ __('messages.nav_gam_committee') }}</a></li>
                    <li><a href="{{ route('live.darshan') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-yellow-200 font-bold"><i class="fa-solid fa-video text-[10px]"></i> {{ __('messages.nav_live_darshan') }}</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-white/90"><i class="fa-solid fa-angle-right text-yellow-300 text-[10px]"></i> {{ __('messages.nav_gallery') }}</a></li>
                    <li><a href="{{ route('trust') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-white/90"><i class="fa-solid fa-angle-right text-yellow-300 text-[10px]"></i> {{ __('messages.nav_trust') }}</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-white/90"><i class="fa-solid fa-angle-right text-yellow-300 text-[10px]"></i> {{ __('messages.nav_blog') }}</a></li>
                </ul>
            </div>

            <!-- Col 3: Pilgrim Services -->
            <div>
                <h4 class="text-yellow-300 font-extrabold text-sm mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span> {{ __('messages.footer_pilgrim_services') }}
                </h4>
                <ul class="space-y-2.5 text-xs">
                    <li><a href="{{ route('donation') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-white/90"><i class="fa-solid fa-hand-holding-dollar text-yellow-300"></i> {{ __('messages.nav_donation') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-yellow-300 transition flex items-center gap-2 text-white/90"><i class="fa-solid fa-location-dot text-yellow-300"></i> {{ __('messages.nav_contact') }}</a></li>
                </ul>

                <div class="mt-6 pt-4 border-t border-white/20 text-xs">
                    <span class="text-yellow-300 font-bold block mb-1.5">{{ __('messages.footer_lang_select') }}</span>
                    <div class="inline-flex gap-2 text-xs bg-white/10 px-3 py-1.5 rounded-xl border border-yellow-300/30">
                        <a href="{{ route('locale.switch', 'gu') }}" class="font-bold hover:underline {{ app()->getLocale() == 'gu' ? 'text-yellow-300' : 'text-white' }}">ગુજરાતી</a>
                        <span class="text-yellow-300/50">|</span>
                        <a href="{{ route('locale.switch', 'en') }}" class="font-bold hover:underline {{ app()->getLocale() == 'en' ? 'text-yellow-300' : 'text-white' }}">English</a>
                    </div>
                </div>
            </div>

            <!-- Col 4: Contact Information -->
            <div>
                <h4 class="text-yellow-300 font-extrabold text-sm mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span> {{ __('messages.footer_office') }}
                </h4>
                <ul class="space-y-3 text-xs text-orange-100">
                    <li class="flex items-start gap-2.5">
                        <i class="fa-solid fa-location-dot text-yellow-300 mt-1"></i>
                        <span>{{ __('messages.contact_addr_val') }}</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-phone text-yellow-300"></i>
                        <span>+91 98765 43210</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-solid fa-envelope text-yellow-300"></i>
                        <span>trust@gatraddham.org</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fa-brands fa-whatsapp text-emerald-300 text-sm"></i>
                        <span class="text-white font-semibold">{{ __('messages.contact_whatsapp_avail') }}</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="mt-12 pt-6 border-t border-white/20 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-orange-200">
            <p>© {{ date('Y') }} {{ __('messages.site_subtitle') }}. {{ __('messages.rights_reserved') }}</p>
            <div class="flex items-center gap-3 text-yellow-300 font-bold">
                <span>{{ __('messages.mantra') }}</span>
            </div>
        </div>
    </div>
</footer>
