<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', __('messages.site_title') . ' | ' . __('messages.site_subtitle'))</title>
    <meta name="description" content="@yield('meta_description', 'શ્રી ગાત્રાળ ધામ - નિત્ય દર્શન, આરતી સમય પત્રક, સદાબ્રત અન્નક્ષેત્ર મહાપ્રસાદ, ગૌશાળા અને ઓનલાઇન યાત્રી સુવિધાઓ.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Noto+Sans+Gujarati:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS (CDN for instant, zero-cache utility rendering) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        temple: {
                            50: '#fff7ed',
                            100: '#ffedd5',
                            200: '#fed7aa',
                            300: '#fdba74',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        :root {
            --color-primary-orange: #ea580c;
            --color-bright-yellow: #facc15;
            --color-pure-white: #ffffff;
        }
        body {
            font-family: 'Plus Jakarta Sans', 'Noto Sans Gujarati', sans-serif;
            background-color: #fcfbf9;
            color: #1e293b;
        }
        .heading-divine {
            font-family: 'Cinzel', 'Noto Sans Gujarati', serif;
        }
        .text-gradient-orange-yellow {
            background: linear-gradient(135deg, #d97706 0%, #ea580c 50%, #c2410c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-temple-mesh {
            background-color: #fcfbf9;
            background-image: radial-gradient(rgba(234, 88, 12, 0.08) 1.5px, transparent 0);
            background-size: 24px 24px;
        }
        /* Custom Yellow - White - Orange Theme Button */
        .btn-theme-gradient {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 50%, #c2410c 100%);
            color: #ffffff;
            box-shadow: 0 4px 18px -2px rgba(234, 88, 12, 0.4);
            border: 1px solid rgba(254, 240, 138, 0.4);
        }
        .btn-theme-gradient:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f97316 50%, #ea580c 100%);
            box-shadow: 0 6px 24px -2px rgba(234, 88, 12, 0.55);
            transform: translateY(-1px);
        }
        .card-white-theme {
            background-color: #ffffff;
            border: 1px solid rgba(251, 146, 60, 0.25);
            box-shadow: 0 4px 20px -4px rgba(234, 88, 12, 0.08);
        }
        .card-white-theme:hover {
            border-color: rgba(234, 88, 12, 0.6);
            box-shadow: 0 10px 30px -4px rgba(234, 88, 12, 0.15);
        }
    </style>

    @stack('styles')
</head>
<body class="bg-temple-mesh min-h-screen flex flex-col selection:bg-orange-500 selection:text-white">

    <!-- Top Devotional Bar (Yellow, White, Orange) -->
    <div class="bg-gradient-to-r from-orange-600 via-amber-500 to-orange-600 text-white text-xs py-2 px-4 shadow-sm border-b border-yellow-300/40">
        <div class="max-w-7xl mx-auto flex flex-wrap justify-between items-center gap-2">
            <div class="flex items-center gap-3">
                <span class="font-bold flex items-center gap-1.5">
                    <span class="text-yellow-200">🚩</span>
                    <span>{{ __('messages.site_subtitle') }}</span>
                </span>
                <span class="hidden sm:inline text-yellow-200">•</span>
                <span class="hidden md:inline font-medium text-white/90">🕒 {{ __('messages.darshan_timings') }}</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1.5 text-yellow-100 font-bold bg-orange-700/50 px-2.5 py-0.5 rounded-full border border-yellow-300/30">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-300 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-yellow-300"></span>
                    </span>
                    {{ __('messages.live_darshan_badge') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Header Navigation -->
    @include('frontend.partials.header')

    <!-- Flash Alert Messages -->
    @if(session('receipt'))
        <div class="max-w-7xl mx-auto px-4 mt-6">
            <div class="bg-white border-2 border-emerald-500 rounded-3xl p-6 text-slate-800 shadow-xl">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="flex-grow">
                        <h3 class="text-lg font-bold text-slate-900">શ્રી ગાત્રાળ માતાજીના આશીર્વાદ! આપનું દાન સફળતાપૂર્વક નોંધાઈ ગયું છે.</h3>
                        <p class="text-xs text-slate-600 mt-1">આપનો રસીદ નંબર: <strong class="text-orange-600 font-mono text-sm">{{ session('receipt.receipt_no') }}</strong></p>
                        <div class="mt-3 flex flex-wrap gap-4 text-xs bg-orange-50/70 p-3 rounded-xl border border-orange-200/60">
                            <div>દાતા: <strong class="text-slate-900">{{ session('receipt.donor_name') }}</strong></div>
                            <div>રકમ: <strong class="text-emerald-700 font-bold text-sm">₹ {{ number_format(session('receipt.amount')) }}</strong></div>
                            <div>હેતુ: <strong class="text-orange-700">{{ session('receipt.cause') }}</strong></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if(session('contact_success'))
        <div class="max-w-7xl mx-auto px-4 mt-6">
            <div class="bg-white border-2 border-emerald-500 text-emerald-950 px-5 py-4 rounded-3xl flex items-center gap-3 shadow-xl">
                <i class="fa-solid fa-circle-check text-emerald-600 text-xl"></i>
                <span class="text-sm font-semibold">{{ session('contact_success') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content Slot -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('frontend.partials.footer')

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
