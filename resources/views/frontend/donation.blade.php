@extends('frontend.layouts.master')

@section('title', __('messages.don_title') . ' | ' . __('messages.site_title'))

@section('content')

    <!-- Banner Header (Yellow, White, Orange) -->
    <div class="py-14 bg-gradient-to-b from-orange-50 via-amber-50 to-white border-b-2 border-orange-100 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm">
                {{ __('messages.don_badge') }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 heading-divine mt-4">
                {{ __('messages.don_title') }}
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-medium">
                {{ __('messages.don_subtitle') }}
            </p>
        </div>
    </div>

    <!-- Official Donation Receipt Modal/Banner if submitted -->
    @if(session('receipt'))
        <div class="max-w-5xl mx-auto px-4 pt-10">
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-2 border-emerald-400 rounded-3xl p-6 sm:p-8 shadow-xl text-slate-800">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5 pb-4 border-b border-emerald-200">
                    <div class="flex items-center gap-3 text-emerald-800">
                        <i class="fa-solid fa-circle-check text-3xl text-emerald-600"></i>
                        <div>
                            <h3 class="text-base sm:text-lg font-black">{{ app()->getLocale() == 'gu' ? 'દાન સફળતાપૂર્વક નોંધાયું છે!' : 'Donation Recorded Successfully!' }}</h3>
                            <p class="text-xs text-emerald-700 font-semibold">{{ app()->getLocale() == 'gu' ? 'શ્રી ગાત્રાળ માતાજી મંદિર ચેરીટેબલ ટ્રસ્ટ તરફથી હાર્દિક આભાર' : 'Thank you for your generous contribution to Shree Gatrad Dham Trust.' }}</p>
                        </div>
                    </div>
                    <span class="px-3.5 py-1 bg-emerald-600 text-white text-xs font-black rounded-full self-start sm:self-auto shadow-sm">
                        {{ session('receipt.status') }}
                    </span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs bg-white/80 p-4 rounded-2xl border border-emerald-200">
                    <div>
                        <span class="text-slate-500 block text-[11px] font-bold uppercase tracking-wider">Receipt No</span>
                        <span class="font-mono font-bold text-slate-900 text-xs sm:text-sm">{{ session('receipt.receipt_no') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block text-[11px] font-bold uppercase tracking-wider">Donor Name</span>
                        <span class="font-bold text-slate-900 text-xs sm:text-sm">{{ session('receipt.donor_name') }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block text-[11px] font-bold uppercase tracking-wider">Amount</span>
                        <span class="font-black text-emerald-700 text-sm sm:text-base">₹{{ number_format(session('receipt.amount'), 2) }}</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block text-[11px] font-bold uppercase tracking-wider">Seva Cause</span>
                        <span class="font-bold text-slate-900 text-xs sm:text-sm line-clamp-1">{{ session('receipt.cause') }}</span>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10" x-data="{ 
            selectedAmount: 5100,
            copiedUpi: false,
            activeAppNotice: '',
            payViaUpi(appName) {
                const inputEl = document.getElementById('amount_input');
                const inputVal = inputEl ? inputEl.value : null;
                const amount = (inputVal && !isNaN(inputVal) && Number(inputVal) > 0) ? Number(inputVal) : (this.selectedAmount || 501);
                const upiId = 'gatraddhamdevgam@sbi';
                const payeeName = 'Shree Gatrad Mataji Mandir Trust';
                const note = encodeURIComponent('Temple Seva ' + appName);
                
                // Copy UPI ID to clipboard
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(upiId).catch(() => {});
                }
                this.copiedUpi = true;
                setTimeout(() => this.copiedUpi = false, 3000);

                // Flash App Notice
                this.activeAppNotice = appName;
                setTimeout(() => this.activeAppNotice = '', 6000);

                // Standard UPI Deep-link URI
                const upiUrl = 'upi://pay?pa=' + encodeURIComponent(upiId) + 
                               '&pn=' + encodeURIComponent(payeeName) + 
                               '&am=' + encodeURIComponent(amount) + 
                               '&cu=INR&tn=' + note;
                
                // Trigger UPI Intent
                window.location.href = upiUrl;
            }
        }">
            
            <!-- Left Column: Donation Form -->
            <div class="lg:col-span-7">
                <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 sm:p-8 shadow-xl">
                    <h2 class="text-xl font-black text-slate-900 heading-divine mb-2 flex items-center gap-2">
                        <i class="fa-solid fa-hand-holding-heart text-orange-600"></i>
                        <span>{{ __('messages.don_form_title') }}</span>
                    </h2>
                    <p class="text-xs text-slate-600 mb-6 font-medium">{{ __('messages.don_form_sub') }}</p>

                    <form action="{{ route('donation.submit') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Pre-set Donation Amounts (Yellow, White, Orange) -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-2">{{ __('messages.don_amount_select') }}</label>
                            <div class="grid grid-cols-4 gap-2">
                                <button type="button" @click="selectedAmount = 501; document.getElementById('amount_input').value = 501" :class="selectedAmount === 501 ? 'border-orange-500 bg-orange-600 text-white shadow-md' : 'border-orange-200 bg-orange-50/50 text-slate-700 hover:border-orange-300'" class="py-2.5 rounded-xl border-2 text-xs font-black transition">
                                    {{ app()->getLocale() == 'gu' ? '₹ ૫૦૧' : '₹ 501' }}
                                </button>
                                <button type="button" @click="selectedAmount = 1100; document.getElementById('amount_input').value = 1100" :class="selectedAmount === 1100 ? 'border-orange-500 bg-orange-600 text-white shadow-md' : 'border-orange-200 bg-orange-50/50 text-slate-700 hover:border-orange-300'" class="py-2.5 rounded-xl border-2 text-xs font-black transition">
                                    {{ app()->getLocale() == 'gu' ? '₹ ૧,૧૦૦' : '₹ 1,100' }}
                                </button>
                                <button type="button" @click="selectedAmount = 2100; document.getElementById('amount_input').value = 2100" :class="selectedAmount === 2100 ? 'border-orange-500 bg-orange-600 text-white shadow-md' : 'border-orange-200 bg-orange-50/50 text-slate-700 hover:border-orange-300'" class="py-2.5 rounded-xl border-2 text-xs font-black transition">
                                    {{ app()->getLocale() == 'gu' ? '₹ ૨,૧૦૦' : '₹ 2,100' }}
                                </button>
                                <button type="button" @click="selectedAmount = 5100; document.getElementById('amount_input').value = 5100" :class="selectedAmount === 5100 ? 'border-orange-500 bg-orange-600 text-white shadow-md' : 'border-orange-200 bg-orange-50/50 text-slate-700 hover:border-orange-300'" class="py-2.5 rounded-xl border-2 text-xs font-black transition">
                                    {{ app()->getLocale() == 'gu' ? '₹ ૫,૧૦૦' : '₹ 5,100' }}
                                </button>
                            </div>
                        </div>

                        <!-- Amount Input -->
                        <div>
                            <label for="amount_input" class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.don_amount_other') }}</label>
                            <input type="number" id="amount_input" name="amount" value="5100" min="1" @input="selectedAmount = Number($event.target.value)" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-bold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <!-- Cause Selection -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.don_cause_label') }}</label>
                            <select name="cause" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-800 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                                @foreach($causes as $c)
                                    <option value="{{ $c['title'] }}">{{ $c['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Donor Name -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.don_name_label') }}</label>
                            <input type="text" name="donor_name" placeholder="{{ __('messages.don_name_placeholder') }}" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <!-- Mobile & PAN -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.don_phone_label') }}</label>
                                <input type="tel" name="donor_phone" placeholder="98XXXXXXXX" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">{{ __('messages.don_pan_label') }}</label>
                                <input type="text" name="donor_pan" placeholder="ABCDE1234F" class="w-full bg-white border-2 border-orange-200 rounded-xl px-4 py-3 text-sm text-slate-900 font-semibold focus:outline-none focus:border-orange-500 uppercase shadow-sm">
                            </div>
                        </div>

                        <button type="submit" class="w-full btn-theme-gradient font-black py-4 rounded-xl text-base shadow-xl flex items-center justify-center gap-2 mt-4">
                            <i class="fa-solid fa-receipt text-yellow-200"></i>
                            <span>{{ __('messages.don_submit_btn') }}</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Column: UPI QR Card & Instant App Payment -->
            <div class="lg:col-span-5 space-y-6">
                
                <!-- UPI QR Card with Real Scannable QR and Direct App Payments -->
                <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 text-center shadow-xl relative overflow-hidden">
                    <div class="inline-flex items-center gap-1.5 text-[11px] font-black text-orange-800 uppercase bg-yellow-200 px-4 py-1 rounded-full border border-yellow-400 shadow-sm mb-3">
                        <i class="fa-solid fa-qrcode text-orange-600"></i>
                        <span>{{ __('messages.don_upi_title') }}</span>
                    </div>

                    <h3 class="text-base font-black text-slate-900 heading-divine">
                        {{ __('messages.don_upi_apps') }}
                    </h3>
                    
                    <!-- Genuine High-Resolution UPI QR Code -->
                    <div class="my-4 inline-block bg-white p-3 rounded-2xl shadow-md border-2 border-yellow-400">
                        <img 
                            src="/uploads/donation/upi_qr_code.png" 
                            alt="Shree Gatrad Dham UPI QR Code" 
                            class="w-48 h-48 mx-auto object-contain rounded-xl"
                        >
                        <div class="text-[11px] font-bold text-slate-800 mt-2">
                            Shree Gatrad Mataji Mandir Trust
                        </div>
                    </div>

                    <!-- UPI ID with One-Click Copy -->
                    <div class="bg-orange-50 border-2 border-orange-200 rounded-2xl p-3 flex items-center justify-between gap-2 max-w-sm mx-auto">
                        <div class="text-left">
                            <span class="text-[10px] text-slate-500 font-bold block uppercase tracking-wider">UPI ID</span>
                            <span class="font-mono text-xs sm:text-sm font-black text-orange-700 select-all">gatraddhamdevgam@sbi</span>
                        </div>
                        <button 
                            type="button" 
                            @click="navigator.clipboard.writeText('gatraddhamdevgam@sbi'); copiedUpi = true; setTimeout(() => copiedUpi = false, 2500)"
                            class="px-3 py-1.5 bg-orange-600 hover:bg-orange-500 text-white rounded-xl text-xs font-bold transition flex items-center gap-1 shrink-0 shadow-sm"
                        >
                            <i :class="copiedUpi ? 'fa-solid fa-check text-emerald-300' : 'fa-regular fa-copy'"></i>
                            <span x-text="copiedUpi ? 'Copied!' : 'Copy'"></span>
                        </button>
                    </div>

                    <!-- Interactive UPI App Payment Buttons -->
                    <div class="mt-5 pt-4 border-t border-orange-100">
                        <div class="text-xs font-black text-slate-800 mb-3 uppercase tracking-wider flex items-center justify-center gap-1.5">
                            <i class="fa-solid fa-mobile-screen-button text-orange-600"></i>
                            <span>{{ app()->getLocale() == 'gu' ? 'UPI એપ દ્વારા સીધું ચુકવણી કરો:' : 'Click to Pay via UPI App:' }}</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2.5 max-w-sm mx-auto">
                            <!-- Google Pay -->
                            <button type="button" 
                                    @click="payViaUpi('Google Pay')" 
                                    class="group flex items-center justify-center gap-2 p-3 rounded-2xl border-2 border-slate-200 hover:border-emerald-500 bg-white hover:bg-emerald-50/40 shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                                <span class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-xs font-black group-hover:bg-emerald-600 group-hover:text-white transition">
                                    <i class="fa-brands fa-google"></i>
                                </span>
                                <div class="text-left">
                                    <span class="text-xs font-black text-slate-800 block leading-tight">Google Pay</span>
                                    <span class="text-[9px] text-emerald-600 font-bold block">{{ app()->getLocale() == 'gu' ? 'તરત ચુકવો' : 'Pay Now' }}</span>
                                </div>
                            </button>

                            <!-- PhonePe -->
                            <button type="button" 
                                    @click="payViaUpi('PhonePe')" 
                                    class="group flex items-center justify-center gap-2 p-3 rounded-2xl border-2 border-slate-200 hover:border-purple-500 bg-white hover:bg-purple-50/40 shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                                <span class="w-8 h-8 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center text-xs font-black group-hover:bg-purple-600 group-hover:text-white transition">
                                    <i class="fa-solid fa-bolt"></i>
                                </span>
                                <div class="text-left">
                                    <span class="text-xs font-black text-slate-800 block leading-tight">PhonePe</span>
                                    <span class="text-[9px] text-purple-600 font-bold block">{{ app()->getLocale() == 'gu' ? 'તરત ચુકવો' : 'Pay Now' }}</span>
                                </div>
                            </button>

                            <!-- Paytm -->
                            <button type="button" 
                                    @click="payViaUpi('Paytm')" 
                                    class="group flex items-center justify-center gap-2 p-3 rounded-2xl border-2 border-slate-200 hover:border-sky-500 bg-white hover:bg-sky-50/40 shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                                <span class="w-8 h-8 rounded-full bg-sky-100 text-sky-700 flex items-center justify-center text-xs font-black group-hover:bg-sky-600 group-hover:text-white transition">
                                    <i class="fa-solid fa-wallet"></i>
                                </span>
                                <div class="text-left">
                                    <span class="text-xs font-black text-slate-800 block leading-tight">Paytm</span>
                                    <span class="text-[9px] text-sky-600 font-bold block">{{ app()->getLocale() == 'gu' ? 'તરત ચુકવો' : 'Pay Now' }}</span>
                                </div>
                            </button>

                            <!-- BHIM UPI -->
                            <button type="button" 
                                    @click="payViaUpi('BHIM UPI')" 
                                    class="group flex items-center justify-center gap-2 p-3 rounded-2xl border-2 border-slate-200 hover:border-orange-500 bg-white hover:bg-orange-50/40 shadow-sm hover:shadow transition transform hover:-translate-y-0.5">
                                <span class="w-8 h-8 rounded-full bg-orange-100 text-orange-700 flex items-center justify-center text-xs font-black group-hover:bg-orange-600 group-hover:text-white transition">
                                    <i class="fa-solid fa-indian-rupee-sign"></i>
                                </span>
                                <div class="text-left">
                                    <span class="text-xs font-black text-slate-800 block leading-tight">BHIM UPI</span>
                                    <span class="text-[9px] text-orange-600 font-bold block">{{ app()->getLocale() == 'gu' ? 'તરત ચુકવો' : 'Pay Now' }}</span>
                                </div>
                            </button>
                        </div>

                        <!-- Active Notice Toast -->
                        <template x-if="activeAppNotice">
                            <div class="mt-3 p-3 rounded-2xl bg-amber-50 border border-amber-300 text-amber-900 text-xs font-bold text-center animate-pulse">
                                <span x-text="'Opening ' + activeAppNotice + ' for ₹' + (document.getElementById('amount_input')?.value || selectedAmount) + '...'"></span>
                                <div class="text-[10px] text-slate-500 font-normal mt-0.5">
                                    {{ app()->getLocale() == 'gu' ? 'જો એપ ન ખૂલે તો ઉપર આપેલ QR કોડ સ્કેન કરો.' : 'If app does not open automatically, scan the QR code above.' }}
                                </div>
                            </div>
                        </template>
                    </div>

                    <p class="text-xs text-slate-600 font-medium mt-3">
                        {{ __('messages.don_scan_instruction') }}
                    </p>
                </div>

                <!-- WhatsApp Confirmation Card -->
                <div class="p-4 bg-emerald-50 border-2 border-emerald-300 rounded-3xl flex items-start gap-3 text-emerald-900 text-xs shadow-sm">
                    <i class="fa-brands fa-whatsapp text-emerald-600 text-2xl mt-0.5 shrink-0"></i>
                    <div>
                        <span class="font-black text-sm block">{{ app()->getLocale() == 'gu' ? 'દાન કર્યા બાદ રસીદ મેળવવા:' : 'To receive 80G Tax Receipt:' }}</span>
                        <span class="text-[11px] leading-relaxed block mt-1">
                            {{ app()->getLocale() == 'gu' ? 'ચુકવણી કર્યા પછી ટ્રાન્ઝેક્શન UTR / સ્ક્રીનશોટ તમારા નામ સાથે WhatsApp કરો: ' : 'Send your transaction UTR / payment screenshot along with your name to: ' }}
                            <a href="https://wa.me/919825014521" target="_blank" class="font-bold underline text-emerald-700 hover:text-emerald-800">+91 98250 14521</a>
                        </span>
                    </div>
                </div>

                <!-- 80G Tax Exemption Note -->
                <div class="p-4 rounded-2xl bg-yellow-50 border-2 border-yellow-300 text-xs text-amber-900 font-semibold flex items-center gap-3 shadow-sm">
                    <i class="fa-solid fa-award text-yellow-600 text-2xl shrink-0"></i>
                    <span>{{ __('messages.don_tax_note') }}</span>
                </div>

            </div>

        </div>
    </div>

@endsection
