<aside class="w-72 bg-white border-r-2 border-orange-100 flex flex-col shrink-0 transition-all duration-300 z-40 fixed inset-y-0 left-0 lg:static lg:translate-x-0 shadow-lg"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    <!-- Logo / Brand Header -->
    <div class="h-20 flex items-center gap-3 px-6 border-b border-orange-100 bg-gradient-to-r from-orange-50 via-amber-50/40 to-white">
        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-amber-400 via-orange-500 to-orange-600 flex items-center justify-center text-white font-black text-xl shadow-md border-2 border-yellow-300 shrink-0">
            🪔
        </div>
        <div class="min-w-0">
            <h1 class="font-black text-slate-900 text-base tracking-wide truncate">
                {{ app()->getLocale() == 'gu' ? 'ગાત્રાળ ધામ' : 'Gatrad Dham' }}
            </h1>
            <span class="text-[10px] text-orange-600 uppercase tracking-widest font-extrabold block">
                {{ app()->getLocale() == 'gu' ? 'એડમિન કંટ્રોલ પેનલ' : 'ADMIN CONTROL PANEL' }}
            </span>
        </div>
    </div>

    <!-- Navigation Menu Items (Spacious & Clean Layout) -->
    <div class="flex-1 px-4 py-6 overflow-y-auto space-y-6">
        
        <!-- Category 1: Overview -->
        <div>
            <div class="text-[10px] font-black text-orange-900 uppercase tracking-widest px-3 mb-2.5">
                {{ app()->getLocale() == 'gu' ? 'મુખ્ય કંટ્રોલ (Overview)' : 'MAIN MENU' }}
            </div>

            <div class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-3 rounded-2xl text-xs font-bold transition-all {{ request()->routeIs('admin.dashboard*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center text-sm shrink-0">
                        <i class="fa-solid fa-gauge-high"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'ડેશબોર્ડ (Dashboard)' : 'Dashboard' }}</span>
                </a>
            </div>
        </div>

        <!-- Category 2: Website CMS Pages (Unified Clean Modules) -->
        <div class="pt-2 border-t border-orange-100/80">
            <div class="text-[10px] font-black text-orange-900 uppercase tracking-widest px-3 mb-2.5 flex items-center justify-between">
                <span>{{ app()->getLocale() == 'gu' ? 'પેજ મેનેજમેન્ટ (Website Pages)' : 'WEBSITE PAGES' }}</span>
                <span class="text-[9px] px-2 py-0.5 rounded-full bg-orange-100 text-orange-700 font-bold">
                    {{ app()->getLocale() == 'gu' ? '૮ પેજ' : '8 Modules' }}
                </span>
            </div>

            <div class="space-y-2">
                <!-- 0. Hero Sliders -->
                <a href="{{ route('admin.sliders.index') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.sliders*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-yellow-100/80 text-yellow-800 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-panorama"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'હોમ સ્લાઇડર (Hero Sliders)' : 'Home Hero Sliders' }}</span>
                </a>

                <!-- 1. Home / Aarti -->
                <a href="{{ route('admin.aarti.index') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.aarti*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-orange-100/80 text-orange-600 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-house-chimney"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'હોમ & આરતી (Home/Aarti)' : 'Home & Aarti Timings' }}</span>
                </a>

                <!-- 2. About Us / Temple History -->
                <a href="{{ route('admin.about.index') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.about*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-orange-100/80 text-orange-600 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-om"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'ઇતિહાસ & મહિમા (About Us)' : 'About Us & History' }}</span>
                </a>

                <!-- 3. Unified Committee Members (Gam & Trust) -->
                <a href="{{ route('admin.committees.index', ['type' => 'gam']) }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.committees*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-amber-100/80 text-amber-700 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-people-roof"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'સમિતિ સભ્યો (Committees)' : 'Committee Members' }}</span>
                </a>

                <!-- 3. Gallery -->
                <a href="{{ route('admin.gallery.index') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.gallery*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-yellow-100/80 text-yellow-800 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-images"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'દર્શન ગેલેરી (Gallery)' : 'Photo Gallery' }}</span>
                </a>

                <!-- 4. Trust Seva Activities -->
                <a href="{{ route('admin.trust.index') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.trust*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-rose-100/80 text-rose-600 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'ટ્રસ્ટ સેવા પ્રવૃત્તિઓ (Trust Seva)' : 'Trust Seva Activities' }}</span>
                </a>

                <!-- 5. Blog / News -->
                <a href="{{ route('admin.blogs.index') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.blogs*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-blue-100/80 text-blue-600 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-newspaper"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'સમાચાર & બ્લોગ (Blogs)' : 'News & Events Blog' }}</span>
                </a>

                <!-- 6. Live Darshan -->
                <a href="{{ route('admin.live-darshan.index') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.live-darshan*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-red-100/80 text-red-600 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-video"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'લાઈવ દર્શન સેટિંગ્સ' : 'Live Darshan Settings' }}</span>
                </a>

                <!-- 7. Contacts / Inquiries -->
                <a href="{{ route('admin.contacts.index') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.contacts*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-teal-100/80 text-teal-700 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'સંપર્ક સંદેશાઓ (Contacts)' : 'Contact Inquiries' }}</span>
                </a>
            </div>
        </div>

        <!-- Category 3: Services / Transactions -->
        <div class="pt-2 border-t border-orange-100/80">
            <div class="text-[10px] font-black text-orange-900 uppercase tracking-widest px-3 mb-2.5">
                {{ app()->getLocale() == 'gu' ? 'દાન વ્યવસ્થા (Donations)' : 'DONATIONS' }}
            </div>

            <div class="space-y-2">
                <a href="{{ route('admin.donations.index') }}" 
                   class="flex items-center gap-3.5 px-3.5 py-2.5 rounded-2xl text-xs font-semibold transition-all {{ request()->routeIs('admin.donations*') ? 'bg-orange-50 text-orange-600 border-2 border-orange-200 font-bold shadow-sm' : 'text-slate-700 hover:bg-orange-50/70 hover:text-orange-600 border border-transparent' }}">
                    <div class="w-8 h-8 rounded-xl bg-emerald-100/80 text-emerald-600 flex items-center justify-center text-xs shrink-0">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                    <span>{{ app()->getLocale() == 'gu' ? 'દાન રેકોર્ડ્સ (Donations)' : 'E-Donation Records' }}</span>
                </a>
            </div>
        </div>

        <!-- Public Link Shortcut -->
        <div class="pt-2">
            <a href="{{ route('home') }}" target="_blank"
               class="flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold text-orange-900 bg-gradient-to-r from-yellow-100 via-amber-100 to-orange-100 hover:from-yellow-200 hover:to-orange-200 border-2 border-yellow-300 transition shadow-sm group">
                <span class="flex items-center gap-3">
                    <i class="fa-solid fa-globe text-orange-600 text-sm"></i>
                    <span>{{ app()->getLocale() == 'gu' ? 'લાઈવ વેબસાઇટ જુઓ' : 'View Public Website' }}</span>
                </span>
                <i class="fa-solid fa-arrow-up-right-from-square text-[11px] text-orange-700 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition"></i>
            </a>
        </div>

    </div>

    <!-- Admin User Info Bar -->
    <div class="p-4 border-t-2 border-orange-100 bg-orange-50/60 shrink-0">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-white border-2 border-orange-200 flex items-center justify-center text-orange-600 font-bold text-sm shadow-sm shrink-0">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-black text-slate-900 truncate">
                    {{ app()->getLocale() == 'gu' ? 'ટ્રસ્ટ એડમિન' : 'Trust Admin' }}
                </p>
                <p class="text-[10px] text-emerald-700 font-bold truncate flex items-center gap-1.5 mt-0.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    {{ app()->getLocale() == 'gu' ? 'ઓનલાઇન સિસ્ટમ' : 'Active Online' }}
                </p>
            </div>
        </div>
    </div>

</aside>
