@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
    $totalCount = \App\Models\GalleryItem::count();
    $darshanCount = \App\Models\GalleryItem::where('category', 'darshan')->count();
    $utsavCount = \App\Models\GalleryItem::where('category', 'utsav')->count();
    $mandirCount = \App\Models\GalleryItem::where('category', 'mandir')->count();
    $featuredCount = \App\Models\GalleryItem::where('is_featured', true)->count();
@endphp

@section('title', $isGu ? 'દર્શન ફોટો ગેલેરી સંચાલન | શ્રી ગાત્રાળ ધામ એડમિન' : 'Gallery Management | Shree Gatrad Dham Admin')

@section('content')

<div x-data="{
    viewMode: 'list',
    addModal: false,
    editModal: false,
    previewModal: false,
    previewImage: '',
    previewTitle: '',
    addPreviewUrl: null,
    editItem: {},
    editPreviewUrl: null,

    openEdit(item) {
        this.editItem = Object.assign({}, item);
        this.editPreviewUrl = null;
        this.editModal = true;
    },

    openPreview(imageUrl, title) {
        this.previewImage = imageUrl;
        this.previewTitle = title;
        this.previewModal = true;
    }
}">

    <!-- Top Header & Primary Action -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2.5">
                <span class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-600 text-white flex items-center justify-center text-lg shadow-md shadow-orange-500/20">
                    <i class="fa-solid fa-images"></i>
                </span>
                <span>{{ $isGu ? 'દર્શન ફોટો ગેલેરી સંચાલન' : 'Darshan Gallery Management' }}</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1 font-semibold">
                {{ $isGu ? 'શ્રી ગાત્રાળ માતાજીના શૃંગાર, મહોત્સવો અને મંદિર પરિસરના દિવ્ય ફોટોઝનું વ્યવસ્થિત સંચાલન.' : 'Upload, organize, and showcase sacred Darshan, festival, and campus photography.' }}
            </p>
        </div>

        <button type="button" 
                @click="addModal = true; addPreviewUrl = null"
                class="px-5 py-2.5 rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white text-xs font-black flex items-center justify-center gap-2 shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 hover:scale-[1.02] transition">
            <i class="fa-solid fa-cloud-arrow-up text-sm"></i>
            <span>{{ $isGu ? '+ નવો ફોટો અપલોડ કરો' : '+ Upload New Photo' }}</span>
        </button>
    </div>

    <!-- Feedback Alerts -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs font-bold flex items-center gap-2.5 shadow-sm">
            <i class="fa-solid fa-circle-check text-base text-emerald-600"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-300 text-rose-800 text-xs font-bold space-y-1 shadow-sm">
            @foreach($errors->all() as $err)
                <p class="flex items-center gap-1.5"><i class="fa-solid fa-triangle-exclamation text-rose-500"></i> {{ $err }}</p>
            @endforeach
        </div>
    @endif

    <!-- Quick KPI Summary Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3.5 mb-6">
        <!-- Total Photos -->
        <a href="{{ route('admin.gallery.index') }}" 
           class="p-4 rounded-2xl border-2 transition {{ !request('category') ? 'bg-orange-50/80 border-orange-400 shadow-sm' : 'bg-white border-orange-100 hover:border-orange-200' }}">
            <div class="flex items-center justify-between text-slate-500 text-[11px] font-bold">
                <span>{{ $isGu ? 'કુલ ફોટોઝ' : 'Total Photos' }}</span>
                <i class="fa-solid fa-photo-film text-orange-500"></i>
            </div>
            <div class="text-xl font-black text-slate-900 mt-1.5 font-mono">{{ $totalCount }}</div>
        </a>

        <!-- Shringar Darshan -->
        <a href="{{ route('admin.gallery.index', ['category' => 'darshan']) }}" 
           class="p-4 rounded-2xl border-2 transition {{ request('category') == 'darshan' ? 'bg-amber-50/80 border-amber-400 shadow-sm' : 'bg-white border-orange-100 hover:border-orange-200' }}">
            <div class="flex items-center justify-between text-slate-500 text-[11px] font-bold">
                <span>{{ $isGu ? 'શૃંગાર દર્શન' : 'Shringar Darshan' }}</span>
                <span class="text-amber-500">🪔</span>
            </div>
            <div class="text-xl font-black text-slate-900 mt-1.5 font-mono">{{ $darshanCount }}</div>
        </a>

        <!-- Utsav & Events -->
        <a href="{{ route('admin.gallery.index', ['category' => 'utsav']) }}" 
           class="p-4 rounded-2xl border-2 transition {{ request('category') == 'utsav' ? 'bg-purple-50/80 border-purple-400 shadow-sm' : 'bg-white border-orange-100 hover:border-orange-200' }}">
            <div class="flex items-center justify-between text-slate-500 text-[11px] font-bold">
                <span>{{ $isGu ? 'ઉત્સવ દર્શન' : 'Festivals' }}</span>
                <span class="text-purple-500">🚩</span>
            </div>
            <div class="text-xl font-black text-slate-900 mt-1.5 font-mono">{{ $utsavCount }}</div>
        </a>

        <!-- Temple Campus -->
        <a href="{{ route('admin.gallery.index', ['category' => 'mandir']) }}" 
           class="p-4 rounded-2xl border-2 transition {{ request('category') == 'mandir' ? 'bg-emerald-50/80 border-emerald-400 shadow-sm' : 'bg-white border-orange-100 hover:border-orange-200' }}">
            <div class="flex items-center justify-between text-slate-500 text-[11px] font-bold">
                <span>{{ $isGu ? 'મંદિર પરિસર' : 'Temple Campus' }}</span>
                <span class="text-emerald-500">🏛️</span>
            </div>
            <div class="text-xl font-black text-slate-900 mt-1.5 font-mono">{{ $mandirCount }}</div>
        </a>

        <!-- Featured on Home -->
        <div class="p-4 rounded-2xl border-2 bg-white border-orange-100">
            <div class="flex items-center justify-between text-slate-500 text-[11px] font-bold">
                <span>{{ $isGu ? 'હોમપેજ મુખ્ય' : 'Featured on Home' }}</span>
                <i class="fa-solid fa-star text-amber-500"></i>
            </div>
            <div class="text-xl font-black text-amber-600 mt-1.5 font-mono">{{ $featuredCount }}</div>
        </div>
    </div>

    <!-- Gallery Management Card -->
    <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-xl">
        
        <!-- Filter Bar & View Mode Toggle -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6 pb-4 border-b border-orange-100">
            <!-- Segmented Category Tabs -->
            <div class="flex flex-wrap items-center gap-1.5 bg-orange-50/80 p-1.5 rounded-2xl border border-orange-200 text-xs">
                <a href="{{ route('admin.gallery.index') }}" 
                   class="px-3 py-1.5 rounded-xl font-bold transition flex items-center gap-1.5 {{ !request('category') ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:text-orange-600' }}">
                    <span>{{ $isGu ? 'બધા ફોટોઝ' : 'All Photos' }}</span>
                    <span class="text-[10px] px-1.5 py-0.2 rounded-full {{ !request('category') ? 'bg-white/20 text-white' : 'bg-orange-100 text-orange-800' }}">{{ $totalCount }}</span>
                </a>
                <a href="{{ route('admin.gallery.index', ['category' => 'darshan']) }}" 
                   class="px-3 py-1.5 rounded-xl font-bold transition flex items-center gap-1.5 {{ request('category') == 'darshan' ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:text-orange-600' }}">
                    <span>🪔 {{ $isGu ? 'શૃંગાર દર્શન' : 'Darshan' }}</span>
                    <span class="text-[10px] px-1.5 py-0.2 rounded-full {{ request('category') == 'darshan' ? 'bg-white/20 text-white' : 'bg-orange-100 text-orange-800' }}">{{ $darshanCount }}</span>
                </a>
                <a href="{{ route('admin.gallery.index', ['category' => 'utsav']) }}" 
                   class="px-3 py-1.5 rounded-xl font-bold transition flex items-center gap-1.5 {{ request('category') == 'utsav' ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:text-orange-600' }}">
                    <span>🚩 {{ $isGu ? 'ઉત્સવ & મેળાઓ' : 'Events' }}</span>
                    <span class="text-[10px] px-1.5 py-0.2 rounded-full {{ request('category') == 'utsav' ? 'bg-white/20 text-white' : 'bg-orange-100 text-orange-800' }}">{{ $utsavCount }}</span>
                </a>
                <a href="{{ route('admin.gallery.index', ['category' => 'mandir']) }}" 
                   class="px-3 py-1.5 rounded-xl font-bold transition flex items-center gap-1.5 {{ request('category') == 'mandir' ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:text-orange-600' }}">
                    <span>🏛️ {{ $isGu ? 'મંદિર પરિસર' : 'Campus' }}</span>
                    <span class="text-[10px] px-1.5 py-0.2 rounded-full {{ request('category') == 'mandir' ? 'bg-white/20 text-white' : 'bg-orange-100 text-orange-800' }}">{{ $mandirCount }}</span>
                </a>
            </div>

            <!-- List / Grid View Switcher -->
            <div class="flex items-center gap-1.5 bg-orange-50/80 p-1 rounded-2xl border border-orange-200 self-start md:self-auto">
                <button type="button" 
                        @click="viewMode = 'list'" 
                        :class="viewMode === 'list' ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:text-orange-600'" 
                        class="px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5" 
                        title="{{ $isGu ? 'લિસ્ટ વ્યૂ' : 'List View' }}">
                    <i class="fa-solid fa-list"></i>
                    <span>{{ $isGu ? 'લિસ્ટ' : 'List' }}</span>
                </button>
                <button type="button" 
                        @click="viewMode = 'grid'" 
                        :class="viewMode === 'grid' ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-600 hover:text-orange-600'" 
                        class="px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5" 
                        title="{{ $isGu ? 'ગ્રીડ વ્યૂ' : 'Grid View' }}">
                    <i class="fa-solid fa-grip"></i>
                    <span>{{ $isGu ? 'ગ્રીડ' : 'Grid' }}</span>
                </button>
            </div>
        </div>

        <!-- ==================== 1. LIST VIEW (PRIMARY USER REQUEST) ==================== -->
        <div x-show="viewMode === 'list'" class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-gradient-to-r from-orange-500 to-amber-500 text-white font-black text-xs uppercase tracking-wider">
                        <th class="py-3.5 px-4 rounded-l-2xl w-24">{{ $isGu ? 'ફોટો' : 'Photo' }}</th>
                        <th class="py-3.5 px-4">{{ $isGu ? 'શીર્ષક / વિગત' : 'Title / Details' }}</th>
                        <th class="py-3.5 px-4">{{ $isGu ? 'કેટેગરી' : 'Category' }}</th>
                        <th class="py-3.5 px-4 text-center">{{ $isGu ? 'હોમપેજ' : 'Featured' }}</th>
                        <th class="py-3.5 px-4">{{ $isGu ? 'તારીખ' : 'Date' }}</th>
                        <th class="py-3.5 px-4 rounded-r-2xl text-right">{{ $isGu ? 'ક્રિયા' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-orange-100/70">
                    @forelse($items as $photo)
                        <tr class="hover:bg-amber-50/50 transition-colors duration-150">
                            <!-- Image Thumbnail Column -->
                            <td class="py-3.5 px-4">
                                <div class="relative w-16 h-16 rounded-2xl overflow-hidden border-2 border-orange-200 cursor-pointer group shadow-sm bg-slate-100 shrink-0"
                                     @click="openPreview('{{ $photo->image_url }}', '{{ addslashes($photo->title) }}')">
                                    <img src="{{ $photo->image_url }}" 
                                         alt="{{ $photo->title_en }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                                         loading="lazy"
                                         onerror="this.onerror=null; this.src='/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg';">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs transition">
                                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                                    </div>
                                </div>
                            </td>

                            <!-- Title & Subtitle -->
                            <td class="py-3.5 px-4">
                                <div class="font-black text-slate-900 text-sm">
                                    {{ $photo->title_gu ?: $photo->title_en }}
                                </div>
                                @if($photo->title_en && $photo->title_en !== $photo->title_gu)
                                    <div class="text-[11px] text-slate-500 font-medium mt-0.5">
                                        {{ $photo->title_en }}
                                    </div>
                                @endif
                            </td>

                            <!-- Category Badge -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                @if($photo->category == 'darshan')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[11px] font-black bg-amber-100 text-amber-800 border border-amber-300">
                                        🪔 {{ $isGu ? 'શૃંગાર દર્શન' : 'Darshan' }}
                                    </span>
                                @elseif($photo->category == 'utsav')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[11px] font-black bg-purple-100 text-purple-800 border border-purple-300">
                                        🚩 {{ $isGu ? 'ઉત્સવ' : 'Utsav' }}
                                    </span>
                                @elseif($photo->category == 'mandir')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[11px] font-black bg-emerald-100 text-emerald-800 border border-emerald-300">
                                        🏛️ {{ $isGu ? 'પરિસર' : 'Campus' }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[11px] font-black bg-orange-100 text-orange-800 border border-orange-300">
                                        🍲 {{ $isGu ? 'અન્નક્ષેત્ર' : 'Seva' }}
                                    </span>
                                @endif
                            </td>

                            <!-- Featured Status -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                @if($photo->is_featured)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[11px] font-black bg-gradient-to-r from-amber-400 to-yellow-500 text-slate-950 shadow-sm border border-yellow-300">
                                        <i class="fa-solid fa-star text-[9px]"></i>
                                        <span>{{ $isGu ? 'હા' : 'Yes' }}</span>
                                    </span>
                                @else
                                    <span class="text-slate-400 font-bold">-</span>
                                @endif
                            </td>

                            <!-- Upload Date -->
                            <td class="py-3.5 px-4 text-slate-500 font-medium whitespace-nowrap">
                                {{ $photo->created_at->format('d M Y') }}
                            </td>

                            <!-- Actions (Icon Only) -->
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Preview Button -->
                                    <button type="button" 
                                            @click="openPreview('{{ $photo->image_url }}', '{{ addslashes($photo->title) }}')"
                                            class="w-8 h-8 rounded-xl bg-orange-50 hover:bg-orange-100 text-orange-600 border border-orange-200 flex items-center justify-center text-xs transition shadow-sm"
                                            title="{{ $isGu ? 'મોટો ફોટો જુઓ' : 'Preview Photo' }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <!-- Edit Button (Icon Only) -->
                                    <button type="button" 
                                            @click="openEdit({{ json_encode($photo) }})" 
                                            class="w-8 h-8 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 flex items-center justify-center text-xs transition shadow-sm" 
                                            title="{{ $isGu ? 'એડિટ' : 'Edit' }}">
                                        <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                                    </button>

                                    <!-- Delete Button (Icon Only) -->
                                    <form action="{{ route('admin.gallery.destroy', $photo->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('{{ $isGu ? 'શું તમે આ ફોટો ખરેખર ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this photo?' }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-8 h-8 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 flex items-center justify-center text-xs transition shadow-sm" 
                                                title="{{ $isGu ? 'ડિલીટ' : 'Delete' }}">
                                            <i class="fa-solid fa-trash-can text-rose-500"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center">
                                <i class="fa-solid fa-images text-4xl text-orange-300 mb-2 block"></i>
                                <span class="font-bold text-slate-500">{{ $isGu ? 'હાલ કોઈ ફોટોઝ નથી.' : 'No photos available.' }}</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ==================== 2. GRID VIEW (ALTERNATIVE VIEW) ==================== -->
        <div x-show="viewMode === 'grid'" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6" style="display: none;">
            @forelse($items as $photo)
                <div class="bg-white border-2 border-orange-100 hover:border-orange-400 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <!-- Photo Header & Preview Area -->
                    <div>
                        <div class="aspect-[4/3] w-full overflow-hidden bg-slate-100 relative cursor-pointer"
                             @click="openPreview('{{ $photo->image_url }}', '{{ addslashes($photo->title) }}')">
                            <img src="{{ $photo->image_url }}" 
                                 alt="{{ $photo->title_en }}" 
                                 class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg';">
                            
                            <!-- Category Badge -->
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider backdrop-blur-md shadow-md {{ $photo->category == 'darshan' ? 'bg-amber-500/90 text-white' : ($photo->category == 'utsav' ? 'bg-purple-600/90 text-white' : 'bg-emerald-600/90 text-white') }}">
                                @if($photo->category == 'darshan') 🪔 {{ $isGu ? 'શૃંગાર' : 'Darshan' }}
                                @elseif($photo->category == 'utsav') 🚩 {{ $isGu ? 'ઉત્સવ' : 'Utsav' }}
                                @else 🏛️ {{ $isGu ? 'પરિસર' : 'Mandir' }}
                                @endif
                            </span>

                            @if($photo->is_featured)
                                <span class="absolute top-3 right-3 px-2.5 py-1 rounded-xl text-[10px] font-black bg-gradient-to-r from-amber-400 to-yellow-500 text-slate-950 shadow-md flex items-center gap-1 border border-yellow-300">
                                    <i class="fa-solid fa-star text-[9px]"></i>
                                    <span>{{ $isGu ? 'મુખ્ય' : 'Featured' }}</span>
                                </span>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="w-10 h-10 rounded-full bg-white/90 text-orange-600 flex items-center justify-center text-sm shadow-xl transform scale-75 group-hover:scale-100 transition duration-300">
                                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                                </span>
                            </div>
                        </div>

                        <div class="p-4">
                            <h3 class="font-black text-slate-900 text-xs sm:text-sm line-clamp-1 group-hover:text-orange-600 transition" title="{{ $photo->title_gu ?: $photo->title_en }}">
                                {{ $photo->title_gu ?: $photo->title_en }}
                            </h3>
                            @if($photo->title_en && $photo->title_en !== $photo->title_gu)
                                <p class="text-[11px] text-slate-500 truncate mt-0.5" title="{{ $photo->title_en }}">
                                    {{ $photo->title_en }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Card Actions Footer (Icon Only) -->
                    <div class="px-4 py-3 bg-gradient-to-b from-white to-orange-50/40 border-t border-orange-100 flex items-center justify-between gap-2">
                        <span class="text-[10px] text-slate-400 font-medium">
                            <i class="fa-regular fa-calendar mr-1"></i>{{ $photo->created_at->format('d M Y') }}
                        </span>

                        <div class="flex items-center gap-1.5 shrink-0">
                            <!-- Edit Button (Icon Only) -->
                            <button type="button" 
                                    @click="openEdit({{ json_encode($photo) }})" 
                                    class="w-7 h-7 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 flex items-center justify-center text-xs transition shadow-sm" 
                                    title="{{ $isGu ? 'એડિટ' : 'Edit' }}">
                                <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                            </button>

                            <!-- Delete Form (Icon Only) -->
                            <form action="{{ route('admin.gallery.destroy', $photo->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('{{ $isGu ? 'શું તમે આ ફોટો ખરેખર ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this photo?' }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-7 h-7 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 flex items-center justify-center text-xs transition shadow-sm" 
                                        title="{{ $isGu ? 'ડિલીટ' : 'Delete' }}">
                                    <i class="fa-solid fa-trash-can text-rose-500"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center rounded-3xl bg-orange-50/40 border-2 border-dashed border-orange-200">
                    <i class="fa-solid fa-images text-5xl text-orange-300 mb-3 block"></i>
                    <h3 class="font-black text-slate-800 text-sm">
                        {{ $isGu ? 'આ કેટેગરીમાં હાલ કોઈ ફોટોઝ નથી.' : 'No photos in this category yet.' }}
                    </h3>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8 pt-4 border-t border-slate-100">
            {{ $items->links() }}
        </div>
    </div>

    <!-- ==================== ADD GALLERY PHOTO MODAL ==================== -->
    <div x-show="addModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
         style="display: none;">
        
        <div class="bg-white border-2 border-orange-300 rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl relative my-8" @click.away="addModal = false">
            <button type="button" @click="addModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="mb-5 flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                </div>
                <div>
                    <span class="text-[10px] font-black text-orange-700 uppercase bg-yellow-200 px-2.5 py-0.5 rounded-full border border-yellow-400">
                        {{ $isGu ? 'નવો ફોટો' : 'NEW PHOTO' }}
                    </span>
                    <h2 class="text-xl font-black text-slate-900 mt-1">
                        {{ $isGu ? 'ગેલેરીમાં નવો ફોટો અપલોડ કરો' : 'Upload New Gallery Photo' }}
                    </h2>
                </div>
            </div>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf

                <!-- Category -->
                <div>
                    <label class="block font-bold text-slate-800 mb-1">
                        {{ $isGu ? 'કેટેગરી પસંદ કરો*' : 'Select Category*' }}
                    </label>
                    <select name="category" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        <option value="darshan">🪔 {{ $isGu ? 'શૃંગાર દર્શન (Shringar Darshan)' : 'Shringar Darshan' }}</option>
                        <option value="utsav">🚩 {{ $isGu ? 'ઉત્સવ & મેળાઓ (Festivals & Events)' : 'Festivals & Events' }}</option>
                        <option value="mandir">🏛️ {{ $isGu ? 'મંદિર પરિસર (Temple Campus)' : 'Temple Campus' }}</option>
                        <option value="seva">🍲 {{ $isGu ? 'અન્નક્ષેત્ર & સેવા (Annakshetra & Seva)' : 'Annakshetra & Seva' }}</option>
                    </select>
                </div>

                <!-- Title (Gujarati & English) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'ફોટો શીર્ષક (ગુજરાતી)*' : 'Title (Gujarati)*' }}</label>
                        <input type="text" name="title_gu" required placeholder="દા.ત. નવરાત્રિ શૃંગાર દર્શન" value="{{ old('title_gu') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'ફોટો શીર્ષક (English)' : 'Title (English)' }}</label>
                        <input type="text" name="title_en" placeholder="e.g. Navratri Shringar Darshan" value="{{ old('title_en') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                </div>

                <!-- Photo File Picker with Live Preview -->
                <div class="p-3.5 bg-orange-50/60 rounded-2xl border-2 border-dashed border-orange-200">
                    <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-camera text-orange-600"></i>
                        <span>{{ $isGu ? 'ફોટો ફાઇલ પસંદ કરો (JPG, PNG)*' : 'Choose Photo File (JPG, PNG)*' }}</span>
                    </label>
                    <input type="file" name="image" accept="image/*" required
                           @change="addPreviewUrl = URL.createObjectURL($event.target.files[0])"
                           class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-600 file:text-white hover:file:bg-orange-700 cursor-pointer">

                    <!-- Live Image Preview -->
                    <template x-if="addPreviewUrl">
                        <div class="mt-3 relative rounded-xl overflow-hidden border-2 border-orange-300 shadow-sm">
                            <img :src="addPreviewUrl" class="w-full h-36 object-cover object-top" alt="Preview">
                            <div class="absolute bottom-1.5 right-1.5 bg-black/70 text-white text-[10px] px-2 py-0.5 rounded-md font-bold">
                                {{ $isGu ? 'નવો ફોટો પ્રિવ્યૂ' : 'Preview' }}
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Featured Toggle -->
                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" id="add_is_featured" name="is_featured" value="1" class="w-4 h-4 text-orange-600 border-orange-300 rounded focus:ring-orange-500">
                    <label for="add_is_featured" class="font-bold text-slate-800">
                        {{ $isGu ? 'હોમપેજ પર મુખ્ય દર્શનમાં દર્શાવો (Featured on Home)' : 'Display as Featured on Home Page' }}
                    </label>
                </div>

                <!-- Submit Buttons -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="addModal = false" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-bold hover:bg-slate-50 transition">
                        {{ $isGu ? 'રદ કરો' : 'Cancel' }}
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span>{{ $isGu ? 'ગેલેરીમાં સેવ કરો' : 'Upload Photo' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== EDIT GALLERY MODAL ==================== -->
    <div x-show="editModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
         style="display: none;">
        
        <div class="bg-white border-2 border-orange-300 rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl relative my-8" @click.away="editModal = false">
            <button type="button" @click="editModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="mb-5 flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <span class="text-[10px] font-black text-amber-800 uppercase bg-amber-100 px-2.5 py-0.5 rounded-full border border-amber-300">
                        {{ $isGu ? 'એડિટ મોડ' : 'EDIT MODE' }}
                    </span>
                    <h2 class="text-xl font-black text-slate-900 mt-1">
                        {{ $isGu ? 'ગેલેરી ફોટો એડિટ કરો' : 'Edit Gallery Photo' }}
                    </h2>
                </div>
            </div>

            <form :action="'/admin/gallery/' + editItem.id" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                <!-- Category -->
                <div>
                    <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'કેટેગરી પસંદ કરો*' : 'Select Category*' }}</label>
                    <select name="category" x-model="editItem.category" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        <option value="darshan">🪔 {{ $isGu ? 'શૃંગાર દર્શન (Shringar Darshan)' : 'Shringar Darshan' }}</option>
                        <option value="utsav">🚩 {{ $isGu ? 'ઉત્સવ & મેળાઓ (Festivals & Events)' : 'Festivals & Events' }}</option>
                        <option value="mandir">🏛️ {{ $isGu ? 'મંદિર પરિસર (Temple Campus)' : 'Temple Campus' }}</option>
                        <option value="seva">🍲 {{ $isGu ? 'અન્નક્ષેત્ર & સેવા (Annakshetra & Seva)' : 'Annakshetra & Seva' }}</option>
                    </select>
                </div>

                <!-- Title (Gujarati & English) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'ફોટો શીર્ષક (ગુજરાતી)*' : 'Title (Gujarati)*' }}</label>
                        <input type="text" name="title_gu" required x-model="editItem.title_gu"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'ફોટો શીર્ષક (English)' : 'Title (English)' }}</label>
                        <input type="text" name="title_en" x-model="editItem.title_en"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                    </div>
                </div>

                <!-- Current Photo & Replace Option -->
                <div class="p-3.5 bg-orange-50/60 rounded-2xl border-2 border-dashed border-orange-200">
                    <label class="block font-bold text-slate-800 mb-1.5 flex items-center justify-between">
                        <span class="flex items-center gap-1.5">
                            <i class="fa-solid fa-camera text-orange-600"></i>
                            <span>{{ $isGu ? 'ફોટો બદલો (વૈકલ્પિક)' : 'Change Photo (Optional)' }}</span>
                        </span>
                        <span class="text-[10px] text-slate-500">{{ $isGu ? '(ખાલી રાખશો તો જૂનો રહેશે)' : '(Leave empty to keep current)' }}</span>
                    </label>
                    
                    <div class="flex items-center gap-3 mb-2.5 p-2 bg-white rounded-xl border border-orange-200">
                        <img :src="editPreviewUrl || editItem.image_url" class="w-14 h-14 rounded-lg object-cover object-top border border-orange-300" alt="Current image">
                        <div class="text-[11px] text-slate-600 truncate">
                            <span class="font-bold text-slate-800 block" x-text="editPreviewUrl ? 'નવો ફોટો પસંદ થયો' : 'હાલનો ફોટો'"></span>
                            <span class="text-slate-400 font-mono text-[10px]" x-text="editItem.image_url"></span>
                        </div>
                    </div>

                    <input type="file" name="image" accept="image/*"
                           @change="editPreviewUrl = URL.createObjectURL($event.target.files[0])"
                           class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-600 file:text-white hover:file:bg-orange-700 cursor-pointer">
                </div>

                <!-- Featured Toggle -->
                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_featured" value="1" id="edit_is_featured" x-model="editItem.is_featured" class="w-4 h-4 text-orange-600 border-orange-300 rounded focus:ring-orange-500">
                    <label for="edit_is_featured" class="font-bold text-slate-800">
                        {{ $isGu ? 'હોમપેજ પર મુખ્ય દર્શનમાં દર્શાવો (Featured on Home)' : 'Featured on Home Page' }}
                    </label>
                </div>

                <!-- Submit Buttons -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="editModal = false" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-bold hover:bg-slate-50 transition">
                        {{ $isGu ? 'રદ કરો' : 'Cancel' }}
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>{{ $isGu ? 'ફેરફાર સાચવો' : 'Save Changes' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== LIGHTBOX FULL PREVIEW MODAL ==================== -->
    <div x-show="previewModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-950/90 backdrop-blur-md flex items-center justify-center p-4"
         style="display: none;">
        
        <div class="relative max-w-4xl w-full text-center" @click.away="previewModal = false">
            <button @click="previewModal = false" class="absolute -top-12 right-0 text-white text-3xl hover:text-yellow-400 transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <img :src="previewImage" :alt="previewTitle" class="max-h-[82vh] max-w-full mx-auto rounded-3xl border-4 border-yellow-400 shadow-2xl object-contain bg-black/40">
            <h4 class="text-white font-bold text-base mt-4" x-text="previewTitle"></h4>
        </div>
    </div>

</div>

@endsection
