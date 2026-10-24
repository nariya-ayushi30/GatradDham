<header class="h-20 bg-white border-b-2 border-orange-100 px-4 sm:px-6 lg:px-7 flex items-center justify-between gap-4 sticky top-0 z-20 shadow-sm">
    
    <!-- Left Section: Mobile Toggle & Page Context -->
    <div class="flex items-center gap-3 sm:gap-4 min-w-0">
        <!-- Mobile Sidebar Toggle -->
        <button @click="sidebarOpen = !sidebarOpen" 
                class="lg:hidden p-2 text-slate-600 hover:text-orange-600 hover:bg-orange-50 rounded-xl transition border border-orange-200"
                aria-label="Toggle Navigation">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        <!-- Breadcrumb Matching Language -->
        <div class="flex items-center gap-2 text-xs font-bold">
            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-orange-50 border border-orange-200 text-orange-700">
                <i class="fa-solid fa-shield-halved text-[11px] text-orange-600"></i>
                <span>{{ app()->getLocale() == 'gu' ? 'ગાત્રાળ ધામ' : 'Gatrad Dham' }}</span>
                <span class="text-orange-300">•</span>
                <span>{{ app()->getLocale() == 'gu' ? 'એડમિન કંટ્રોલ પેનલ' : 'Admin Control Panel' }}</span>
            </span>
            <span class="text-orange-200 hidden md:inline">/</span>
            <span class="text-slate-500 font-semibold hidden md:inline text-[11px]">{{ app()->getLocale() == 'gu' ? 'ડેશબોર્ડ & વિશ્લેષણ' : 'Dashboard & Overview' }}</span>
        </div>
    </div>

    <!-- Center Section: Live Digital Clock Widget (IST) -->
    <div class="hidden xl:flex items-center gap-3 px-4 py-1.5 rounded-xl bg-orange-50/60 border border-orange-200/80 text-xs text-slate-600">
        <i class="fa-regular fa-clock text-orange-500 text-sm"></i>
        <div class="flex items-center gap-2 font-mono font-bold text-slate-800">
            <span id="admin-live-date">--</span>
            <span class="text-orange-300">|</span>
            <span id="admin-live-clock" class="text-orange-600">--:--:--</span>
        </div>
        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
    </div>

    <!-- Right Section: Language Switcher, Live Actions & Profile -->
    <div class="flex items-center gap-2 sm:gap-3 shrink-0">
        
        <!-- BILINGUAL LANGUAGE SWITCHER (English / ગુજરાતી) -->
        <div class="inline-flex items-center bg-yellow-50 border-2 border-yellow-300 rounded-2xl p-1 text-xs shadow-sm">
            <a href="{{ route('locale.switch', 'en') }}" 
               class="px-2.5 py-1 rounded-xl font-black text-xs transition {{ app()->getLocale() == 'en' ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' : 'text-slate-600 hover:text-orange-600' }}">
                English
            </a>
            <a href="{{ route('locale.switch', 'gu') }}" 
               class="px-2.5 py-1 rounded-xl font-black text-xs transition {{ app()->getLocale() == 'gu' ? 'bg-gradient-to-r from-amber-500 to-orange-600 text-white shadow-md' : 'text-slate-600 hover:text-orange-600' }}">
                ગુજરાતી
            </a>
        </div>

        <!-- Live Darshan Quick Status Badge -->
        <a href="{{ route('admin.live-darshan.index') }}" 
           class="hidden sm:inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-bold transition border border-rose-200 bg-rose-50 text-rose-700 hover:bg-rose-100">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-600"></span>
            </span>
            <span class="text-[11px]">{{ app()->getLocale() == 'gu' ? 'લાઈવ દર્શન' : 'Live Darshan' }}</span>
        </a>

        <!-- Live Website Button (Yellow & Orange Theme) -->
        <a href="{{ route('home') }}" target="_blank" 
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-yellow-100 hover:bg-yellow-200 text-orange-900 border-2 border-yellow-300 text-xs font-black shadow-sm transition">
            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-orange-600"></i>
            <span class="hidden sm:inline">{{ app()->getLocale() == 'gu' ? 'પબ્લિક સાઇટ જુઓ' : 'View Website' }}</span>
        </a>

        <!-- Notifications Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.outside="open = false">
            <button @click="open = !open" 
                    class="w-10 h-10 rounded-2xl bg-orange-50 hover:bg-orange-100 border border-orange-200 text-slate-700 hover:text-orange-600 flex items-center justify-center transition relative shadow-sm">
                <i class="fa-regular fa-bell text-sm"></i>
                <span class="absolute top-2.5 right-2.5 w-2 h-2 rounded-full bg-orange-600 ring-2 ring-white"></span>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-100"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border-2 border-orange-100 py-3 z-50"
                 style="display: none;">
                <div class="px-4 pb-2 border-b border-orange-100 flex items-center justify-between">
                    <span class="text-xs font-black text-slate-800">{{ app()->getLocale() == 'gu' ? 'સૂચનાઓ' : 'Notifications' }}</span>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-orange-100 text-orange-700">{{ app()->getLocale() == 'gu' ? 'તાજી માહિતી' : 'Live Updates' }}</span>
                </div>
                <div class="divide-y divide-slate-100 max-h-64 overflow-y-auto text-xs">
                    <a href="{{ route('admin.donations.index') }}" class="p-3 flex items-start gap-3 hover:bg-orange-50/60 transition block">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-hand-holding-dollar text-xs"></i>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-[11px]">{{ app()->getLocale() == 'gu' ? 'નવું દાન નોંધાયું છે' : 'New Donation Recorded' }}</p>
                            <p class="text-[10px] text-slate-500">{{ app()->getLocale() == 'gu' ? 'ભક્તો તરફથી ઓનલાઇન ઈ-દાન જમા થયું છે.' : 'Devotee contribution verified.' }}</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.contacts.index') }}" class="p-3 flex items-start gap-3 hover:bg-orange-50/60 transition block">
                        <div class="w-8 h-8 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-[11px]">{{ app()->getLocale() == 'gu' ? 'યાત્રી સંપર્ક સંદેશાઓ' : 'Devotee Inquiries' }}</p>
                            <p class="text-[10px] text-slate-500">{{ app()->getLocale() == 'gu' ? 'ભક્તો દ્વારા વેબસાઇટ પર પૂછપરછ આવી છે.' : 'New messages received from devotees.' }}</p>
                        </div>
                    </a>
                </div>
                <div class="pt-2 px-3 border-t border-orange-100 text-center">
                    <a href="{{ route('admin.contacts.index') }}" class="text-[11px] font-bold text-orange-600 hover:underline">
                        {{ app()->getLocale() == 'gu' ? 'બધા સંદેશાઓ તપાસો →' : 'View Devotee Messages →' }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Admin Profile -->
        <div class="flex items-center gap-2.5 pl-2 sm:pl-3 border-l-2 border-orange-100">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-400 via-orange-500 to-orange-600 flex items-center justify-center text-white font-black text-xs shadow-md border-2 border-yellow-300">
                GD
            </div>
            <div class="hidden md:block text-left">
                <p class="font-black text-slate-900 text-xs leading-tight">{{ app()->getLocale() == 'gu' ? 'ટ્રસ્ટ મંડળ' : 'Trust Admin' }}</p>
                <p class="text-[10px] text-orange-600 font-bold">{{ app()->getLocale() == 'gu' ? 'સુપર એડમિન' : 'Super Admin' }}</p>
            </div>
        </div>

    </div>

</header>

<!-- Dynamic Digital Clock Script -->
<script>
    function updateAdminClock() {
        const now = new Date();
        const clockEl = document.getElementById('admin-live-clock');
        const dateEl = document.getElementById('admin-live-date');
        const isGu = '{{ app()->getLocale() }}' === 'gu';
        
        if (clockEl) {
            let hours = now.getHours();
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12;
            clockEl.textContent = `${String(hours).padStart(2, '0')}:${minutes}:${seconds} ${ampm}`;
        }
        
        if (dateEl) {
            const options = { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' };
            dateEl.textContent = now.toLocaleDateString(isGu ? 'gu-IN' : 'en-GB', options);
        }
    }
    document.addEventListener('DOMContentLoaded', () => {
        updateAdminClock();
        setInterval(updateAdminClock, 1000);
    });
</script>
