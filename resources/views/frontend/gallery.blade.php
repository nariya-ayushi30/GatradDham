@extends('frontend.layouts.master')

@section('title', __('messages.nav_gallery') . ' | ' . __('messages.site_title'))

@section('content')

    <!-- Banner Header (Yellow, White, Orange) -->
    <div class="py-14 bg-gradient-to-b from-orange-50 via-amber-50 to-white border-b-2 border-orange-100 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm">
                {{ __('messages.gallery_badge') }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 heading-divine mt-4">
                {{ __('messages.nav_gallery') }}
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-medium">
                {{ __('messages.gallery_subheading') }}
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16" x-data="{ lightbox: false, activeImage: '', activeTitle: '' }">
        
        <!-- Category Filter Pills (Yellow, White, Orange) -->
        <div class="flex flex-wrap justify-center gap-2 mb-12">
            <a href="{{ route('gallery') }}" 
               class="px-4 py-2 rounded-xl text-xs font-black transition {{ !$category ? 'bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-md' : 'bg-white border-2 border-orange-200 text-slate-700 hover:border-orange-400' }}">
                {{ __('messages.gallery_all') }}
            </a>
            <a href="{{ route('gallery', ['category' => 'darshan']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-black transition {{ $category === 'darshan' ? 'bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-md' : 'bg-white border-2 border-orange-200 text-slate-700 hover:border-orange-400' }}">
                🪔 {{ __('messages.gallery_darshan') }}
            </a>
            <a href="{{ route('gallery', ['category' => 'utsav']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-black transition {{ $category === 'utsav' ? 'bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-md' : 'bg-white border-2 border-orange-200 text-slate-700 hover:border-orange-400' }}">
                🚩 {{ __('messages.gallery_utsav') }}
            </a>
            <a href="{{ route('gallery', ['category' => 'mandir']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-black transition {{ $category === 'mandir' ? 'bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-md' : 'bg-white border-2 border-orange-200 text-slate-700 hover:border-orange-400' }}">
                🏛️ {{ __('messages.gallery_mandir') }}
            </a>
            <a href="{{ route('gallery', ['category' => 'seva']) }}" 
               class="px-4 py-2 rounded-xl text-xs font-black transition {{ $category === 'seva' ? 'bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-md' : 'bg-white border-2 border-orange-200 text-slate-700 hover:border-orange-400' }}">
                🍲 {{ __('messages.gallery_seva') }}
            </a>
        </div>

        <!-- Gallery Uniform Grid (Exact Same Size & Single Consistent Design) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $isGu = app()->getLocale() === 'gu';
                $categoryNames = [
                    'darshan' => $isGu ? 'શૃંગાર દર્શન' : 'Shringar Darshan',
                    'utsav'   => $isGu ? 'ઉત્સવ & મેળાઓ' : 'Festival Darshan',
                    'mandir'  => $isGu ? 'મંદિર પરિસર' : 'Temple Campus',
                    'seva'    => $isGu ? 'અન્નક્ષેત્ર & સેવા' : 'Seva Activities',
                ];
            @endphp
            @forelse($items as $item)
                <div class="bg-white border-2 border-orange-200 hover:border-orange-500 rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 cursor-pointer group flex flex-col justify-between h-full"
                     @click="lightbox = true; activeImage = '{{ $item->image_url }}'; activeTitle = '{{ addslashes($item->title) }}'">
                    
                    <!-- Complete Image Container (No Cropping, Ambient Blurred Backdrop for All Aspect Ratios) -->
                    <div class="h-80 sm:h-88 w-full overflow-hidden bg-slate-950 relative flex items-center justify-center">
                        <!-- Ambient Blurred Color Backdrop -->
                        <img src="{{ $item->image_url }}" 
                             alt="" 
                             class="absolute inset-0 w-full h-full object-cover blur-xl opacity-40 scale-125 pointer-events-none" 
                             aria-hidden="true"
                             onerror="this.style.display='none'">

                        <!-- Full Sharp Uncropped Foreground Image -->
                        <img src="{{ $item->image_url }}" 
                             alt="{{ $item->title }}" 
                             class="relative z-10 max-h-full max-w-full object-contain p-2 group-hover:scale-105 transition-transform duration-500 shadow-2xl"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg';">
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 z-20 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="w-12 h-12 rounded-full bg-white/95 text-orange-600 flex items-center justify-center text-lg shadow-xl transform scale-75 group-hover:scale-100 transition duration-300">
                                <i class="fa-solid fa-expand"></i>
                            </span>
                        </div>

                        <!-- Category Badge -->
                        <span class="absolute top-3 right-3 z-20 text-[10px] font-black uppercase tracking-wider bg-black/70 backdrop-blur-md border border-yellow-400/80 text-yellow-300 px-3 py-1 rounded-full shadow-lg">
                            {{ $categoryNames[$item->category] ?? ucfirst($item->category) }}
                        </span>
                    </div>

                    <!-- Clean Uniform Photo Title Footer -->
                    <div class="p-4 bg-gradient-to-b from-white to-orange-50/40 border-t border-orange-100 flex items-center justify-between gap-3">
                        <h3 class="font-bold text-slate-800 text-xs sm:text-sm truncate group-hover:text-orange-600 transition" title="{{ $item->title }}">
                            {{ $item->title }}
                        </h3>
                        <span class="text-orange-600 text-xs font-black flex items-center gap-1 shrink-0 group-hover:translate-x-0.5 transition-transform">
                            <i class="fa-solid fa-magnifying-glass-plus"></i>
                        </span>
                    </div>

                </div>
            @empty
                <div class="col-span-full bg-white border-2 border-dashed border-orange-200 rounded-3xl p-12 text-center text-slate-500 text-sm font-semibold">
                    <i class="fa-solid fa-images text-4xl text-orange-400 mb-3 block"></i>
                    {{ app()->getLocale() == 'gu' ? 'હાલમાં કોઈ ફોટોઝ ઉપલબ્ધ નથી. એડમિન પેનલમાંથી ફોટોઝ ઉમેરી શકો છો.' : 'No photos available yet. Upload photos from admin panel.' }}
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $items->links() }}
        </div>

        <!-- Lightbox Modal -->
        <div x-show="lightbox" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4"
             style="display: none;">
            
            <div class="relative max-w-4xl w-full text-center" @click.away="lightbox = false">
                <button @click="lightbox = false" class="absolute -top-12 right-0 text-white text-3xl hover:text-yellow-400 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <img :src="activeImage" :alt="activeTitle" class="max-h-[82vh] max-w-full mx-auto rounded-3xl border-4 border-yellow-400 shadow-2xl object-contain bg-black/40">
                <h4 class="text-white font-bold text-base mt-4" x-text="activeTitle"></h4>
            </div>
        </div>

    </div>

@endsection
