<header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b-2 border-orange-100 shadow-md" x-data="{ mobileOpen: false, aboutDropdown: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-amber-400 via-orange-500 to-orange-600 p-0.5 shadow-md group-hover:scale-105 transition duration-300">
                    <div class="w-full h-full rounded-2xl bg-white flex items-center justify-center text-orange-600 text-2xl font-bold">
                        🪔
                    </div>
                </div>
                <div>
                    <span class="text-xl sm:text-2xl font-black text-slate-900 group-hover:text-orange-600 transition heading-divine block leading-tight">
                        {{ __('messages.site_title') }}
                    </span>
                    <span class="text-[10px] sm:text-xs text-orange-600 font-bold uppercase tracking-wider block">
                        {{ __('messages.site_subtitle') }}
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden xl:flex items-center gap-1 text-[13px] font-bold text-slate-700">
                <a href="{{ route('home') }}" 
                   class="px-3.5 py-2 rounded-xl transition {{ request()->routeIs('home') ? 'text-orange-600 bg-orange-50 border border-orange-200 shadow-sm' : 'hover:text-orange-600 hover:bg-orange-50/50' }}">
                    {{ __('messages.nav_home') }}
                </a>

                <!-- About & Committee Dropdown -->
                <div class="relative" @mouseenter="aboutDropdown = true" @mouseleave="aboutDropdown = false">
                    <button type="button" class="px-3.5 py-2 rounded-xl transition flex items-center gap-1.5 {{ request()->routeIs('about*') || request()->routeIs('committee*') ? 'text-orange-600 bg-orange-50 border border-orange-200' : 'hover:text-orange-600 hover:bg-orange-50/50' }}">
                        <span>{{ __('messages.nav_about') }}</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-orange-500 transition" :class="aboutDropdown ? 'rotate-180' : ''"></i>
                    </button>
                    
                    <div x-show="aboutDropdown" 
                         x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-100"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute left-0 mt-1 w-60 bg-white border-2 border-orange-200 rounded-2xl shadow-2xl py-2 z-50 text-xs"
                         style="display: none;">
                        <a href="{{ route('about') }}" class="block px-4 py-2.5 text-slate-700 hover:bg-orange-50 hover:text-orange-600 font-semibold transition flex items-center gap-2.5">
                            <i class="fa-solid fa-om text-orange-500"></i>
                            <span>{{ __('messages.nav_about') }}</span>
                        </a>
                        <a href="{{ route('committee.trust') }}" class="block px-4 py-2.5 text-slate-700 hover:bg-orange-50 hover:text-orange-600 font-semibold transition flex items-center gap-2.5 border-t border-slate-100">
                            <i class="fa-solid fa-users text-orange-500"></i>
                            <span>{{ __('messages.nav_committee') }}</span>
                        </a>
                        <a href="{{ route('committee.gam') }}" class="block px-4 py-2.5 text-slate-700 hover:bg-orange-50 hover:text-orange-600 font-semibold transition flex items-center gap-2.5 border-t border-slate-100">
                            <i class="fa-solid fa-people-roof text-orange-500"></i>
                            <span>{{ __('messages.nav_gam_committee') }}</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('live.darshan') }}" 
                   class="px-3.5 py-2 rounded-xl transition flex items-center gap-1.5 {{ request()->routeIs('live.darshan') ? 'text-red-600 bg-red-50 border border-red-200' : 'hover:text-red-600 hover:bg-red-50/50' }}">
                    <span class="w-2 h-2 rounded-full bg-red-500 animate-ping"></span>
                    <span>{{ __('messages.nav_live_darshan') }}</span>
                </a>

                <a href="{{ route('gallery') }}" 
                   class="px-3.5 py-2 rounded-xl transition {{ request()->routeIs('gallery') ? 'text-orange-600 bg-orange-50 border border-orange-200 shadow-sm' : 'hover:text-orange-600 hover:bg-orange-50/50' }}">
                    {{ __('messages.nav_gallery') }}
                </a>

                <a href="{{ route('trust') }}" 
                   class="px-3.5 py-2 rounded-xl transition {{ request()->routeIs('trust') ? 'text-orange-600 bg-orange-50 border border-orange-200 shadow-sm' : 'hover:text-orange-600 hover:bg-orange-50/50' }}">
                    {{ __('messages.nav_trust') }}
                </a>

                <a href="{{ route('blog.index') }}" 
                   class="px-3.5 py-2 rounded-xl transition {{ request()->routeIs('blog*') ? 'text-orange-600 bg-orange-50 border border-orange-200 shadow-sm' : 'hover:text-orange-600 hover:bg-orange-50/50' }}">
                    {{ __('messages.nav_blog') }}
                </a>

                <a href="{{ route('contact') }}" 
                   class="px-3.5 py-2 rounded-xl transition {{ request()->routeIs('contact') ? 'text-orange-600 bg-orange-50 border border-orange-200 shadow-sm' : 'hover:text-orange-600 hover:bg-orange-50/50' }}">
                    {{ __('messages.nav_contact') }}
                </a>
            </nav>

            <!-- Right Controls: Language Switcher & Donate CTA -->
            <div class="flex items-center gap-3">
                
                <!-- BILINGUAL LANGUAGE SWITCHER (Yellow, White, Orange) -->
                <div class="inline-flex items-center bg-yellow-50 border-2 border-yellow-300 rounded-2xl p-1 text-xs shadow-sm">
                    <a href="{{ route('locale.switch', 'gu') }}" 
                       class="px-3 py-1.5 rounded-xl font-black transition {{ app()->getLocale() == 'gu' ? 'bg-gradient-to-r from-amber-400 via-orange-500 to-orange-600 text-white shadow-md' : 'text-slate-600 hover:text-orange-600' }}">
                        ગુજરાતી
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}" 
                       class="px-3 py-1.5 rounded-xl font-black transition {{ app()->getLocale() == 'en' ? 'bg-gradient-to-r from-amber-400 via-orange-500 to-orange-600 text-white shadow-md' : 'text-slate-600 hover:text-orange-600' }}">
                        EN
                    </a>
                </div>

                <!-- Donate CTA -->
                <a href="{{ route('donation') }}" class="hidden sm:flex btn-theme-gradient font-black px-5 py-2.5 rounded-2xl text-xs sm:text-sm items-center gap-1.5 transition">
                    <i class="fa-solid fa-hand-holding-dollar text-yellow-200"></i>
                    <span>{{ __('messages.btn_donate') }}</span>
                </a>

                <!-- Mobile Hamburger Toggle -->
                <button @click="mobileOpen = !mobileOpen" type="button" class="xl:hidden p-2.5 rounded-xl bg-orange-50 text-orange-600 hover:bg-orange-100 transition" aria-label="Toggle menu">
                    <i :class="mobileOpen ? 'fa-solid fa-xmark text-2xl' : 'fa-solid fa-bars text-2xl'"></i>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="mobileOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="xl:hidden bg-white border-b-2 border-orange-200 px-5 pt-4 pb-6 space-y-2 shadow-2xl max-h-[85vh] overflow-y-auto"
         style="display: none;">
        
        <!-- Mobile Language Selector -->
        <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-2">
            <span class="text-xs text-orange-800 font-bold">{{ __('messages.switch_language') }}:</span>
            <div class="inline-flex bg-yellow-50 border-2 border-yellow-300 rounded-xl p-1 text-xs">
                <a href="{{ route('locale.switch', 'gu') }}" class="px-3 py-1 rounded-lg font-bold {{ app()->getLocale() == 'gu' ? 'bg-orange-600 text-white' : 'text-slate-600' }}">ગુજરાતી</a>
                <a href="{{ route('locale.switch', 'en') }}" class="px-3 py-1 rounded-lg font-bold {{ app()->getLocale() == 'en' ? 'bg-orange-600 text-white' : 'text-slate-600' }}">English</a>
            </div>
        </div>

        <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold {{ request()->routeIs('home') ? 'bg-orange-50 text-orange-600 border border-orange-200' : 'text-slate-700 hover:bg-slate-50' }}">
            <i class="fa-solid fa-house text-orange-500 w-5"></i> {{ __('messages.nav_home') }}
        </a>
        <a href="{{ route('about') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold {{ request()->routeIs('about') ? 'bg-orange-50 text-orange-600 border border-orange-200' : 'text-slate-700 hover:bg-slate-50' }}">
            <i class="fa-solid fa-om text-orange-500 w-5"></i> {{ __('messages.nav_about') }}
        </a>
        <a href="{{ route('committee.trust') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold {{ request()->routeIs('committee.trust') ? 'bg-orange-50 text-orange-600 border border-orange-200' : 'text-slate-700 hover:bg-slate-50' }}">
            <i class="fa-solid fa-users text-orange-500 w-5"></i> {{ __('messages.nav_committee') }}
        </a>
        <a href="{{ route('committee.gam') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold {{ request()->routeIs('committee.gam') ? 'bg-orange-50 text-orange-600 border border-orange-200' : 'text-slate-700 hover:bg-slate-50' }}">
            <i class="fa-solid fa-people-roof text-orange-500 w-5"></i> {{ __('messages.nav_gam_committee') }}
        </a>
        <a href="{{ route('live.darshan') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold {{ request()->routeIs('live.darshan') ? 'bg-red-50 text-red-600 border border-red-200' : 'text-slate-700 hover:bg-slate-50' }}">
            <i class="fa-solid fa-video text-red-500 w-5"></i> {{ __('messages.nav_live_darshan') }}
        </a>
        <a href="{{ route('gallery') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold {{ request()->routeIs('gallery') ? 'bg-orange-50 text-orange-600 border border-orange-200' : 'text-slate-700 hover:bg-slate-50' }}">
            <i class="fa-solid fa-images text-orange-500 w-5"></i> {{ __('messages.nav_gallery') }}
        </a>
        <a href="{{ route('trust') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold {{ request()->routeIs('trust') ? 'bg-orange-50 text-orange-600 border border-orange-200' : 'text-slate-700 hover:bg-slate-50' }}">
            <i class="fa-solid fa-hand-holding-heart text-orange-500 w-5"></i> {{ __('messages.nav_trust') }}
        </a>
        <a href="{{ route('blog.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold {{ request()->routeIs('blog*') ? 'bg-orange-50 text-orange-600 border border-orange-200' : 'text-slate-700 hover:bg-slate-50' }}">
            <i class="fa-solid fa-newspaper text-orange-500 w-5"></i> {{ __('messages.nav_blog') }}
        </a>
        <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-bold {{ request()->routeIs('contact') ? 'bg-orange-50 text-orange-600 border border-orange-200' : 'text-slate-700 hover:bg-slate-50' }}">
            <i class="fa-solid fa-location-dot text-orange-500 w-5"></i> {{ __('messages.nav_contact') }}
        </a>

        <div class="pt-3 border-t border-slate-100">
            <a href="{{ route('donation') }}" class="w-full btn-theme-gradient font-bold py-3 rounded-xl text-xs flex items-center justify-center gap-2">
                <i class="fa-solid fa-hand-holding-dollar text-yellow-200"></i>
                <span>{{ __('messages.btn_donate') }}</span>
            </a>
        </div>
    </div>
</header>
