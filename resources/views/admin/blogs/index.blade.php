@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
    $totalCount = \App\Models\BlogPost::count();
    $latestPost = \App\Models\BlogPost::orderBy('published_date', 'desc')->first();
@endphp

@section('title', $isGu ? 'બ્લોગ & સમાચાર સંચાલન | શ્રી ગાત્રાળ ધામ એડમિન' : 'Blog & News Management | Shree Gatrad Dham Admin')

@section('content')

<div x-data="{
    addModal: false,
    editModal: false,
    addPreview: null,
    editPost: {},
    editPreview: null,

    openEdit(item) {
        this.editPost = Object.assign({}, item);
        this.editPreview = null;
        this.editModal = true;
    }
}">

    <!-- Top Header & Primary Action Button -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2.5">
                <span class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-600 text-white flex items-center justify-center text-lg shadow-md shadow-orange-500/20">
                    <i class="fa-solid fa-newspaper"></i>
                </span>
                <span>{{ $isGu ? 'સમાચાર & બ્લોગ સંચાલન' : 'News & Blog Management' }}</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1 font-semibold">
                {{ $isGu ? 'મંદિર ઉત્સવો, ધાર્મિક કાર્યક્રમો અને ટ્રસ્ટની સત્તાવાર જાહેરાતો પોસ્ટ કરો.' : 'Publish temple festivals, religious events, and official announcements.' }}
            </p>
        </div>

        <button type="button" 
                @click="addModal = true; addPreview = null"
                class="px-5 py-2.5 rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white text-xs font-black flex items-center justify-center gap-2 shadow-lg shadow-orange-500/25 hover:shadow-orange-500/40 hover:scale-[1.02] transition">
            <i class="fa-solid fa-pen-nib text-sm"></i>
            <span>{{ $isGu ? '+ નવો લેખ પ્રકાશિત કરો' : '+ Publish New Article' }}</span>
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

    <!-- Quick Stats Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white border-2 border-orange-100 rounded-3xl p-4 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-500 uppercase">{{ $isGu ? 'કુલ પ્રકાશિત લેખો' : 'Total Articles' }}</span>
                <div class="text-2xl font-black text-slate-900 mt-1 font-mono">{{ $totalCount }}</div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>

        <div class="bg-white border-2 border-orange-100 rounded-3xl p-4 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[11px] font-bold text-slate-500 uppercase">{{ $isGu ? 'છેલ્લો લેખ' : 'Latest Article' }}</span>
                <div class="text-xs font-black text-slate-900 mt-1 line-clamp-1 max-w-[200px]" title="{{ $latestPost ? ($latestPost->title_gu ?: $latestPost->title_en) : '-' }}">
                    {{ $latestPost ? ($latestPost->title_gu ?: $latestPost->title_en) : '-' }}
                </div>
                <div class="text-[10px] text-slate-400 font-medium mt-0.5">
                    {{ $latestPost ? \Carbon\Carbon::parse($latestPost->published_date)->format('d M Y') : '' }}
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>

        <a href="{{ route('blog.index') }}" target="_blank" class="bg-white border-2 border-orange-100 hover:border-orange-300 rounded-3xl p-4 shadow-sm flex items-center justify-between transition group">
            <div>
                <span class="text-[11px] font-bold text-slate-500 uppercase">{{ $isGu ? 'જાહેર બ્લોગ પેજ' : 'Public Blog View' }}</span>
                <div class="text-xs font-black text-orange-600 mt-1 flex items-center gap-1 group-hover:underline">
                    <span>{{ $isGu ? 'વેબસાઇટ પર જુઓ' : 'Visit Live Page' }}</span>
                    <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-globe"></i>
            </div>
        </a>
    </div>

    <!-- Main Articles Data Table -->
    <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-xl">
        <div class="flex items-center justify-between mb-5 pb-3 border-b border-orange-100">
            <h2 class="text-base font-black text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-orange-600"></i>
                <span>{{ $isGu ? 'સમાચાર & લેખોની યાદી' : 'Articles & Announcements' }} ({{ $posts->total() }})</span>
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="bg-gradient-to-r from-orange-500 to-amber-500 text-white font-black text-xs uppercase tracking-wider">
                        <th class="py-3.5 px-4 rounded-l-2xl w-24">{{ $isGu ? 'કવર' : 'Cover' }}</th>
                        <th class="py-3.5 px-4">{{ $isGu ? 'લેખ શીર્ષક / સારાંશ' : 'Article Title & Excerpt' }}</th>
                        <th class="py-3.5 px-4">{{ $isGu ? 'પ્રકાશન તારીખ' : 'Published Date' }}</th>
                        <th class="py-3.5 px-4 text-center">{{ $isGu ? 'વેબસાઇટ લિંક' : 'Public Link' }}</th>
                        <th class="py-3.5 px-4 rounded-r-2xl text-right">{{ $isGu ? 'ક્રિયા' : 'Actions' }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-orange-100/70">
                    @forelse($posts as $post)
                        <tr class="hover:bg-amber-50/50 transition-colors duration-150">
                            <!-- Cover Image -->
                            <td class="py-3.5 px-4">
                                <div class="w-16 h-12 rounded-xl overflow-hidden border-2 border-orange-200 bg-slate-100 shrink-0 shadow-sm">
                                    @if($post->image_url)
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title_en }}" class="w-full h-full object-cover"
                                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1544717305-2782549b5136?auto=format&fit=crop&w=300&q=80';">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-orange-500 bg-orange-50">
                                            <i class="fa-solid fa-newspaper text-base"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <!-- Title & Excerpt -->
                            <td class="py-3.5 px-4">
                                <div class="font-black text-slate-900 text-sm">
                                    {{ $post->title_gu ?: $post->title_en }}
                                </div>
                                @if($post->title_en && $post->title_en !== $post->title_gu)
                                    <div class="text-[11px] text-slate-500 font-medium mt-0.5">
                                        {{ $post->title_en }}
                                    </div>
                                @endif
                                <div class="text-[11px] text-slate-600 line-clamp-1 mt-1 max-w-lg">
                                    {{ $post->excerpt_gu ?: ($post->excerpt_en ?: Str::limit(strip_tags((string)$post->content_gu), 90)) }}
                                </div>
                            </td>

                            <!-- Published Date -->
                            <td class="py-3.5 px-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-xl text-[11px] font-bold bg-orange-50 text-orange-700 border border-orange-200">
                                    <i class="fa-regular fa-calendar text-[10px]"></i>
                                    <span>{{ \Carbon\Carbon::parse($post->published_date)->format('d M Y') }}</span>
                                </span>
                            </td>

                            <!-- View Link -->
                            <td class="py-3.5 px-4 text-center whitespace-nowrap">
                                <a href="{{ route('blog.show', $post->slug) }}" target="_blank" 
                                   class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl bg-slate-50 hover:bg-orange-50 text-slate-600 hover:text-orange-600 border border-slate-200 text-[11px] font-bold transition shadow-sm"
                                   title="{{ $isGu ? 'વેબસાઇટ પર જુઓ' : 'View Live' }}">
                                    <span>{{ $post->slug }}</span>
                                    <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i>
                                </a>
                            </td>

                            <!-- Actions (Icon Only) -->
                            <td class="py-3.5 px-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1.5">
                                    <!-- Public Link Button -->
                                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" 
                                       class="w-8 h-8 rounded-xl bg-slate-50 hover:bg-orange-50 text-slate-500 hover:text-orange-600 transition flex items-center justify-center text-xs border border-slate-200 shadow-sm" 
                                       title="{{ $isGu ? 'વેબસાઇટ પર જુઓ' : 'View Public Article' }}">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>

                                    <!-- Edit Button (Icon Only) -->
                                    <button type="button" 
                                            @click="openEdit({{ json_encode($post) }})" 
                                            class="w-8 h-8 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 flex items-center justify-center text-xs transition shadow-sm" 
                                            title="{{ $isGu ? 'એડિટ' : 'Edit' }}">
                                        <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                                    </button>

                                    <!-- Delete Button (Icon Only) -->
                                    <form action="{{ route('admin.blogs.destroy', $post->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('{{ $isGu ? 'શું તમે આ સમાચાર લેખ ખરેખર ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this article?' }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="w-8 h-8 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 flex items-center justify-center text-xs transition shadow-sm" 
                                                title="{{ $isGu ? 'ડિલીટ' : 'Delete' }}">
                                            <i class="fa-solid fa-trash-can text-rose-500"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-slate-400 font-bold">
                                <i class="fa-solid fa-newspaper text-4xl text-orange-200 mb-2 block"></i>
                                <span>{{ $isGu ? 'હજુ સુધી કોઈ લેખ પ્રકાશિત થયો નથી.' : 'No articles published yet.' }}</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 pt-4 border-t border-slate-100">
            {{ $posts->links() }}
        </div>
    </div>

    <!-- ==================== ADD BLOG MODAL ==================== -->
    <div x-show="addModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
         style="display: none;">
        
        <div class="bg-white border-2 border-orange-300 rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative my-8" @click.away="addModal = false">
            <button type="button" @click="addModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="mb-5 flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-pen-nib"></i>
                </div>
                <div>
                    <span class="text-[10px] font-black text-orange-700 uppercase bg-yellow-200 px-2.5 py-0.5 rounded-full border border-yellow-400">
                        {{ $isGu ? 'નવો લેખ' : 'NEW ARTICLE' }}
                    </span>
                    <h2 class="text-xl font-black text-slate-900 mt-1">
                        {{ $isGu ? 'નવો સમાચાર / બ્લોગ લેખ પ્રકાશિત કરો' : 'Publish New Blog Article' }}
                    </h2>
                </div>
            </div>

            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf

                @if($isGu)
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">સમાચાર શીર્ષક (ગુજરાતી)*</label>
                        <input type="text" name="title_gu" required placeholder="દા.ત. ભવ્ય નવરાત્રિ મહોત્સવ આયોજન" value="{{ old('title_gu') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Title in English (Optional)</label>
                        <input type="text" name="title_en" placeholder="e.g. Grand Navratri Festival Celebrations" value="{{ old('title_en') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                    </div>
                @else
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Article Title (English)*</label>
                        <input type="text" name="title_en" required placeholder="e.g. Grand Navratri Festival Celebrations" value="{{ old('title_en') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Title in Gujarati (Optional)</label>
                        <input type="text" name="title_gu" placeholder="દા.ત. ભવ્ય નવરાત્રિ મહોત્સવ આયોજન" value="{{ old('title_gu') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                    </div>
                @endif

                <!-- Published Date -->
                <div>
                    <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'પ્રકાશન તારીખ*' : 'Published Date*' }}</label>
                    <input type="date" name="published_date" required value="{{ old('published_date', date('Y-m-d')) }}"
                           class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-bold shadow-sm">
                </div>

                <!-- Cover Image Upload -->
                <div class="p-3.5 bg-orange-50/60 rounded-2xl border-2 border-dashed border-orange-200">
                    <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-camera text-orange-600"></i>
                        <span>{{ $isGu ? 'આર્ટિકલ કવર ફોટો (JPG, PNG)' : 'Article Cover Image (JPG, PNG)' }}</span>
                    </label>
                    <input type="file" name="image" accept="image/*"
                           @change="addPreview = URL.createObjectURL($event.target.files[0])"
                           class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-600 file:text-white hover:file:bg-orange-700 cursor-pointer">
                    
                    <template x-if="addPreview">
                        <div class="mt-2.5 relative rounded-xl overflow-hidden border border-orange-300">
                            <img :src="addPreview" class="w-full h-32 object-cover" alt="Preview">
                        </div>
                    </template>

                    <div class="mt-2 pt-2 border-t border-orange-100">
                        <label class="block text-[11px] text-slate-500 font-medium mb-1">{{ $isGu ? 'અથવા ઓનલાઇન ફોટો લિંક:' : 'Or paste online image URL:' }}</label>
                        <input type="url" name="image_url" placeholder="https://example.com/cover.jpg" value="{{ old('image_url') }}"
                               class="w-full bg-white border border-slate-300 rounded-xl px-3 py-1.5 text-xs focus:border-orange-500 focus:outline-none">
                    </div>
                </div>

                <!-- Excerpt -->
                @if($isGu)
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">ટૂંકો સારાંશ (Excerpt)</label>
                        <textarea name="excerpt_gu" rows="2" placeholder="મહોત્સવની ટૂંકી રૂપરેખા..."
                                  class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm">{{ old('excerpt_gu') }}</textarea>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-800 mb-1">સંપૂર્ણ સમાચાર વિગત (Content)*</label>
                        <textarea name="content_gu" rows="5" required placeholder="સંપૂર્ણ સમાચારનું લખાણ..."
                                  class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm">{{ old('content_gu') }}</textarea>
                    </div>
                @else
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Short Excerpt (Summary)</label>
                        <textarea name="excerpt_en" rows="2" placeholder="Brief summary of the announcement..."
                                  class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm">{{ old('excerpt_en') }}</textarea>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Detailed Content*</label>
                        <textarea name="content_en" rows="5" required placeholder="Full news article content..."
                                  class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm">{{ old('content_en') }}</textarea>
                    </div>
                @endif

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="addModal = false" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-bold hover:bg-slate-50 transition">
                        {{ $isGu ? 'રદ કરો' : 'Cancel' }}
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>{{ $isGu ? 'લેખ પ્રકાશિત કરો' : 'Publish Article' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== EDIT BLOG MODAL ==================== -->
    <div x-show="editModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
         style="display: none;">
        
        <div class="bg-white border-2 border-orange-300 rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl relative my-8" @click.away="editModal = false">
            <button type="button" @click="editModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 text-xl">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="mb-5 flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-xl shadow-inner">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <span class="text-[10px] font-black text-orange-700 uppercase bg-yellow-200 px-2.5 py-0.5 rounded-full border border-yellow-400">
                        {{ $isGu ? 'એડિટ મોડ' : 'EDIT MODE' }}
                    </span>
                    <h2 class="text-xl font-black text-slate-900 mt-1">
                        {{ $isGu ? 'સમાચાર / લેખ એડિટ કરો' : 'Edit Article / News' }}
                    </h2>
                </div>
            </div>

            <form :action="'/admin/blogs/' + editPost.id" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                @method('PUT')

                @if($isGu)
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">સમાચાર / લેખ શીર્ષક*</label>
                        <input type="text" name="title_gu" required x-model="editPost.title_gu"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Title in English</label>
                        <input type="text" name="title_en" x-model="editPost.title_en"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                    </div>
                @else
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Article Title*</label>
                        <input type="text" name="title_en" required x-model="editPost.title_en"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Title in Gujarati</label>
                        <input type="text" name="title_gu" x-model="editPost.title_gu"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                    </div>
                @endif

                <!-- Published Date -->
                <div>
                    <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'પ્રકાશન તારીખ*' : 'Published Date*' }}</label>
                    <input type="date" name="published_date" required x-model="editPost.published_date"
                           class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-bold shadow-sm">
                </div>

                <!-- Cover Image Upload -->
                <div class="p-3.5 bg-orange-50/60 rounded-2xl border-2 border-dashed border-orange-200">
                    <label class="block font-bold text-slate-800 mb-1.5 flex items-center justify-between">
                        <span class="flex items-center gap-1.5">
                            <i class="fa-solid fa-camera text-orange-600"></i>
                            <span>{{ $isGu ? 'આર્ટિકલ કવર ફોટો બદલો' : 'Change Cover Photo' }}</span>
                        </span>
                        <span class="text-[10px] text-slate-500">{{ $isGu ? '(ખાલી રાખશો તો જૂનો રહેશે)' : '(Leave empty to keep)' }}</span>
                    </label>
                    
                    <div class="flex items-center gap-3 mb-2.5 p-2 bg-white rounded-xl border border-orange-200">
                        <img :src="editPreview || editPost.image_url" class="w-16 h-12 rounded-lg object-cover border border-orange-300" alt="Current image">
                        <div class="text-[11px] text-slate-600 truncate">
                            <span class="font-bold text-slate-800 block" x-text="editPreview ? 'નવો ફોટો પસંદ થયો' : 'હાલનો કવર ફોટો'"></span>
                            <span class="text-slate-400 font-mono text-[10px]" x-text="editPost.image_url"></span>
                        </div>
                    </div>

                    <input type="file" name="image" accept="image/*"
                           @change="editPreview = URL.createObjectURL($event.target.files[0])"
                           class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-600 file:text-white hover:file:bg-orange-700 cursor-pointer">
                </div>

                @if($isGu)
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">ટૂંકો સારાંશ</label>
                        <textarea name="excerpt_gu" rows="2" x-model="editPost.excerpt_gu"
                                  class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm"></textarea>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-800 mb-1">સંપૂર્ણ સમાચાર વિગત*</label>
                        <textarea name="content_gu" rows="5" required x-model="editPost.content_gu"
                                  class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm"></textarea>
                    </div>
                @else
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Short Excerpt</label>
                        <textarea name="excerpt_en" rows="2" x-model="editPost.excerpt_en"
                                  class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm"></textarea>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Full Article Content*</label>
                        <textarea name="content_en" rows="5" required x-model="editPost.content_en"
                                  class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm"></textarea>
                    </div>
                @endif

                <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                    <button type="button" @click="editModal = false" class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs transition">
                        {{ $isGu ? 'રદ કરો' : 'Cancel' }}
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-bold shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk text-yellow-200"></i>
                        <span>{{ $isGu ? 'ફેરફાર સાચવો' : 'Save Changes' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
