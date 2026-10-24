<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#faf8f5]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'શ્રી ગાત્રાળ ધામ | એડમિન પોર્ટલ (Admin Dashboard)')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800;900&family=Noto+Sans+Gujarati:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Chart.js for High-End Interactive Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

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
            --temple-saffron: #f97316;
            --temple-gold: #f59e0b;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Noto Sans Gujarati', system-ui, -apple-system, sans-serif;
            background-color: #faf8f5;
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
        }

        .heading-divine {
            font-family: 'Cinzel', 'Noto Sans Gujarati', serif;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #fdf6ec;
        }
        ::-webkit-scrollbar-thumb {
            background: #fed7aa;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #f97316;
        }

        /* Divine Gradient Button */
        .btn-theme-gradient {
            background: linear-gradient(135deg, #f59e0b 0%, #ea580c 50%, #c2410c 100%);
            color: #ffffff;
            box-shadow: 0 4px 14px -1px rgba(234, 88, 12, 0.35);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-theme-gradient:hover {
            background: linear-gradient(135deg, #fbbf24 0%, #f97316 50%, #ea580c 100%);
            box-shadow: 0 8px 20px -2px rgba(234, 88, 12, 0.45);
            transform: translateY(-1px);
        }

        /* Clean Admin Card Styling Matching Sidebar Theme */
        .admin-card {
            background: #ffffff;
            border: 2px solid #ffedd5;
            border-radius: 1.25rem;
            box-shadow: 0 2px 8px -2px rgba(234, 88, 12, 0.06);
            transition: all 0.25s ease;
        }
        .admin-card:hover {
            box-shadow: 0 12px 24px -6px rgba(234, 88, 12, 0.12);
            border-color: #fdba74;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-[#faf8f5] text-slate-800 min-h-screen flex antialiased" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop Overlay -->
    <div x-show="sidebarOpen" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-30 lg:hidden"
         style="display: none;"></div>

    <!-- Sidebar Navigation -->
    @include('admin.partials.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen overflow-x-hidden">
        
        <!-- Top Admin Header -->
        @include('admin.partials.navbar')

        <!-- Page Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-7 max-w-[1550px] w-full mx-auto">
            @yield('content')
        </main>

        <!-- Admin Footer -->
        <footer class="border-t border-orange-100 bg-white py-4 px-6 text-xs text-slate-500 flex flex-col sm:flex-row justify-between items-center gap-3 mt-auto">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="font-bold text-slate-700">
                    © {{ date('Y') }} શ્રી ગાત્રાળ માતાજી મંદિર ચેરીટેબલ ટ્રસ્ટ — એડમિન પોર્ટલ v2.0
                </span>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-emerald-700 font-bold"><i class="fa-solid fa-circle-check text-xs mr-1 text-emerald-600"></i> સિસ્ટમ ઓનલાઇન & સુરક્ષિત</span>
                <span class="text-orange-200">|</span>
                <a href="{{ route('home') }}" target="_blank" class="text-orange-600 font-bold hover:text-orange-700 flex items-center gap-1 transition">
                    <span>લાઈવ વેબસાઇટ જુઓ</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </a>
            </div>
        </footer>

    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
