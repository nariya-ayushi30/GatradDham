@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
@endphp

@section('title', $isGu ? 'હોમ સ્લાઇડર સંચાલન | શ્રી ગાત્રાળ ધામ એડમિન' : 'Hero Sliders Management | Shree Gatrad Dham Admin')

@section('content')

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-panorama text-orange-600"></i>
                <span>{{ $isGu ? 'હોમ સ્લાઇડર સંચાલન (Hero Sliders)' : 'Hero Sliders Management' }}</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1 font-semibold">
                {{ $isGu ? 'મુખ્ય વેબસાઇટના હોમ પેજ પર દેખાતા મોટા બેનર / સ્લાઇડર્સ અહીંથી ઉમેરો અને મેનેજ કરો.' : 'Add and manage main hero banner sliders shown on the homepage.' }}
            </p>
        </div>
        <div>
            <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 bg-white hover:bg-orange-50 border-2 border-orange-200 text-orange-700 font-bold text-xs rounded-xl flex items-center gap-2 shadow-sm transition">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                <span>{{ $isGu ? 'લાઇવ વેબસાઇટ જુઓ' : 'View Live Website' }}</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold flex items-center gap-2 shadow-sm">
            <i class="fa-solid fa-circle-check text-base"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-rose-100 border border-rose-300 text-rose-800 text-xs font-bold space-y-1 shadow-sm">
            @foreach($errors->all() as $err)
                <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $err }}</p>
            @endforeach
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start" x-data="{ 
        editModalOpen: false, 
        editData: {}, 
        editPreview: null,
        openEdit(item) { 
            this.editData = Object.assign({}, item); 
            this.editPreview = null;
            this.editModalOpen = true; 
        } 
    }">
        
        <!-- Add Slider Form (Col 4) -->
        <div class="lg:col-span-4 admin-card p-6 shadow-sm">
            <h2 class="text-base font-black text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-circle-plus text-orange-600"></i>
                <span>{{ $isGu ? 'નવો સ્લાઇડર ઉમેરો' : 'Add New Hero Slider' }}</span>
            </h2>

            <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs" x-data="{ previewUrl: null }">
                @csrf

                <!-- Title (Single Input based on Active Language) -->
                @if($isGu)
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">સ્લાઇડર શીર્ષક / Title</label>
                        <input type="text" name="title_gu" placeholder="દા.ત. શ્રી ગાત્રાળ માતાજી દિવ્ય શૃંગાર દર્શન" value="{{ old('title_gu') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">સબટાઇટલ / વર્ણન</label>
                        <input type="text" name="subtitle_gu" placeholder="દા.ત. નિત્ય મંગળા અને સંધ્યા આરતીનો પાવન લ્હાવો" value="{{ old('subtitle_gu') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">બટન ટેક્સ્ટ (ઓપ્શનલ)</label>
                        <input type="text" name="button_text_gu" placeholder="દા.ત. લાઈવ દર્શન જુઓ" value="{{ old('button_text_gu') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>
                @else
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Slider Title</label>
                        <input type="text" name="title_en" placeholder="e.g. Shree Gatrad Dham Holy Darshan" value="{{ old('title_en') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Slider Subtitle / Description</label>
                        <input type="text" name="subtitle_en" placeholder="e.g. Daily Aarti and Blessings of Kuldevi Maa" value="{{ old('subtitle_en') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Button Text (Optional)</label>
                        <input type="text" name="button_text_en" placeholder="e.g. View Live Darshan" value="{{ old('button_text_en') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>
                @endif

                <!-- Button Link -->
                <div>
                    <label class="block font-bold text-slate-800 mb-1">
                        {{ $isGu ? 'બટન લિંક (ઓપ્શનલ)' : 'Button Link (Optional)' }}
                    </label>
                    <input type="text" name="button_link" placeholder="દા.ત. /live-darshan અથવા /donation" value="{{ old('button_link') }}"
                           class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                </div>

                <!-- Slider Photo Upload -->
                <div class="p-3.5 bg-orange-50/50 rounded-2xl border-2 border-dashed border-orange-200">
                    <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-image text-orange-600"></i>
                        <span>{{ $isGu ? 'સ્લાઇડર ફોટો અપલોડ કરો*' : 'Upload Slider Photo*' }}</span>
                    </label>

                    <input type="file" name="image" accept="image/*"
                           @change="previewUrl = URL.createObjectURL($event.target.files[0])"
                           class="w-full text-slate-600 text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-500 file:text-white hover:file:bg-orange-600 file:cursor-pointer">

                    <!-- Live Image Preview -->
                    <template x-if="previewUrl">
                        <div class="mt-3 relative rounded-xl overflow-hidden border-2 border-orange-300 shadow-sm">
                            <img :src="previewUrl" class="w-full h-32 object-cover" alt="Preview">
                            <div class="absolute bottom-1 right-1 bg-black/60 text-white text-[9px] px-2 py-0.5 rounded-md font-bold">
                                {{ $isGu ? 'નવો ફોટો પ્રિવ્યૂ' : 'New Preview' }}
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Direct Image URL Alternative -->
                <div>
                    <label class="block font-bold text-slate-800 mb-1">
                        {{ $isGu ? 'અથવા ડાયરેક્ટ ઇમેજ URL (ઓપ્શનલ)' : 'Or Direct Image URL (Optional)' }}
                    </label>
                    <input type="url" name="image_url" placeholder="https://..." value="{{ old('image_url') }}"
                           class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                </div>

                <!-- Order -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'ક્રમ (Order)' : 'Display Order' }}
                        </label>
                        <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'સ્ટેટસ' : 'Status' }}
                        </label>
                        <select name="is_active" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 text-slate-900 font-semibold focus:outline-none focus:border-orange-500">
                            <option value="1">{{ $isGu ? '● સક્રિય (Active)' : '● Active' }}</option>
                            <option value="0">{{ $isGu ? '○ નિષ્ક્રિય (Inactive)' : '○ Inactive' }}</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full btn-theme-gradient font-black py-3 rounded-xl shadow-md text-xs flex items-center justify-center gap-2 mt-4 hover:scale-[1.02] transition">
                    <i class="fa-solid fa-plus-circle text-yellow-200"></i>
                    <span>{{ $isGu ? 'સ્લાઇડર સેવ કરો' : 'Save Hero Slider' }}</span>
                </button>
            </form>
        </div>

        <!-- Sliders List (Col 8) -->
        <div class="lg:col-span-8 admin-card p-6 shadow-sm">
            <div class="flex items-center justify-between pb-4 border-b border-orange-100 mb-6">
                <div>
                    <h2 class="text-base font-black text-slate-900 flex items-center gap-2">
                        <i class="fa-solid fa-list text-orange-600"></i>
                        <span>{{ $isGu ? 'હાલના સ્લાઇડર્સ' : 'Current Sliders' }}</span>
                    </h2>
                    <span class="text-xs text-slate-500 font-medium">
                        {{ $isGu ? 'કુલ ' . count($sliders) . ' સ્લાઇડર્સ નોંધાયેલ છે' : 'Total ' . count($sliders) . ' sliders registered' }}
                    </span>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($sliders as $slider)
                    <div class="bg-gradient-to-r from-orange-50/30 to-white border-2 border-orange-100 hover:border-orange-300 rounded-2xl p-4 transition-all flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                        
                        <!-- Thumbnail & Info -->
                        <div class="flex items-center gap-4 w-full sm:w-auto">
                            <div class="w-24 h-16 rounded-xl overflow-hidden bg-slate-100 border border-orange-200 shrink-0 shadow-inner">
                                <img src="{{ $slider->image }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-[10px] font-black px-2 py-0.5 rounded-full {{ $slider->is_active ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-slate-200 text-slate-700' }}">
                                        {{ $slider->is_active ? ($isGu ? 'સક્રિય' : 'Active') : ($isGu ? 'નિષ્ક્રિય' : 'Inactive') }}
                                    </span>
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-orange-100 text-orange-800">
                                        #{{ $slider->order }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-slate-900 text-sm truncate max-w-xs sm:max-w-md">
                                    {{ $slider->title ?: ($isGu ? 'શીર્ષક વગર' : 'Untitled') }}
                                </h3>
                                @if($slider->subtitle)
                                    <p class="text-xs text-slate-500 truncate max-w-xs sm:max-w-md">
                                        {{ $slider->subtitle }}
                                    </p>
                                @endif
                                @if($slider->button_link)
                                    <span class="text-[10px] text-orange-600 font-semibold block mt-0.5">
                                        <i class="fa-solid fa-link mr-1"></i>{{ $slider->button_link }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2 w-full sm:w-auto justify-end shrink-0">
                            <!-- Edit Button (Icon Only) -->
                            <button type="button" 
                                    @click="openEdit({{ json_encode($slider) }})"
                                    class="w-8 h-8 rounded-xl text-xs transition border bg-amber-50 hover:bg-amber-100 text-amber-800 border-amber-300 flex items-center justify-center shadow-sm"
                                    title="{{ $isGu ? 'સ્લાઇડર એડિટ કરો' : 'Edit Slider' }}">
                                <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('{{ $isGu ? 'શું તમે ખરેખર આ સ્લાઇડર ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this slider?' }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-8 h-8 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 flex items-center justify-center text-xs transition shadow-sm"
                                        title="{{ $isGu ? 'ડિલીટ કરો' : 'Delete' }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-10 text-center rounded-2xl bg-orange-50/50 border-2 border-dashed border-orange-200">
                        <i class="fa-solid fa-panorama text-4xl text-orange-300 mb-3 block"></i>
                        <h3 class="font-bold text-slate-800 text-sm">
                            {{ $isGu ? 'હજુ કોઈ સ્લાઇડર ઉમેરેલ નથી' : 'No sliders added yet' }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                            {{ $isGu ? 'ડાબી બાજુના ફોર્મમાંથી મંદિરના દિવ્ય ફોટોગ્રાફ્સ અને બેનર્સ અપલોડ કરો.' : 'Upload temple photographs and banners using the form on the left.' }}
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- ==================== EDIT SLIDER MODAL ==================== -->
        <div x-show="editModalOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
             style="display: none;">
            
            <div class="bg-white border-2 border-orange-300 rounded-3xl max-w-xl w-full p-6 sm:p-7 shadow-2xl relative my-8" @click.away="editModalOpen = false">
                <!-- Close Button -->
                <button type="button" @click="editModalOpen = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 text-xl">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <div class="mb-5 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-slate-900">
                            {{ $isGu ? 'સ્લાઇડર એડિટ કરો' : 'Edit Hero Slider' }}
                        </h2>
                        <p class="text-xs text-slate-500 font-medium">
                            {{ $isGu ? 'સ્લાઇડર શીર્ષક, વિગત અથવા ફોટો અહીંથી અપડેટ કરો.' : 'Update slider title, details or image below.' }}
                        </p>
                    </div>
                </div>

                <form :action="'/admin/sliders/' + editData.id" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                    @csrf
                    @method('PUT')

                    <!-- Title (Gujarati or English based on active language) -->
                    @if($isGu)
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">સ્લાઇડર શીર્ષક (Title)</label>
                            <input type="text" name="title_gu" x-model="editData.title_gu"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">સબટાઇટલ / વર્ણન (Subtitle)</label>
                            <input type="text" name="subtitle_gu" x-model="editData.subtitle_gu"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">બટન ટેક્સ્ટ (Button Text)</label>
                            <input type="text" name="button_text_gu" x-model="editData.button_text_gu"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                    @else
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">Slider Title</label>
                            <input type="text" name="title_en" x-model="editData.title_en"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">Slider Subtitle</label>
                            <input type="text" name="subtitle_en" x-model="editData.subtitle_en"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">Button Text</label>
                            <input type="text" name="button_text_en" x-model="editData.button_text_en"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                    @endif

                    <!-- Button Link -->
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">
                            {{ $isGu ? 'બટન લિંક (Button Link)' : 'Button Link' }}
                        </label>
                        <input type="text" name="button_link" x-model="editData.button_link"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>

                    <!-- Current Photo & Upload New Photo -->
                    <div class="p-3 bg-orange-50/50 rounded-2xl border-2 border-dashed border-orange-200">
                        <label class="block font-bold text-slate-800 mb-1.5 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-solid fa-image text-orange-600"></i>
                                <span>{{ $isGu ? 'સ્લાઇડર ફોટો બદલો' : 'Change Slider Photo' }}</span>
                            </span>
                            <span class="text-[10px] text-slate-500 font-normal">{{ $isGu ? '(નવો ન રાખવો હોય તો ખાલી રાખો)' : '(Leave empty to keep current)' }}</span>
                        </label>

                        <!-- Current Image Display -->
                        <div class="flex items-center gap-3 mb-2.5 p-2 bg-white rounded-xl border border-orange-200">
                            <img :src="editPreview || editData.image" class="w-20 h-12 rounded-lg object-cover border border-orange-300" alt="Current image">
                            <div class="text-[10px] text-slate-500">
                                <span class="font-bold text-slate-800 block" x-text="editPreview ? 'નવો ફોટો પસંદ થયો' : 'હાલનો ફોટો (Current Image)'"></span>
                                <span class="text-[9px]" x-text="editData.image"></span>
                            </div>
                        </div>

                        <input type="file" name="image" accept="image/*"
                               @change="editPreview = URL.createObjectURL($event.target.files[0])"
                               class="w-full text-slate-600 text-xs file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-500 file:text-white hover:file:bg-orange-600 file:cursor-pointer">
                    </div>

                    <!-- Order & Status -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">
                                {{ $isGu ? 'ક્રમ (Order)' : 'Display Order' }}
                            </label>
                            <input type="number" name="order" x-model="editData.order" min="0"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">
                                {{ $isGu ? 'સ્ટેટસ' : 'Status' }}
                            </label>
                            <select name="is_active" x-model="editData.is_active" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 text-slate-900 font-semibold focus:outline-none focus:border-orange-500">
                                <option :value="1">{{ $isGu ? '● સક્રિય (Active)' : '● Active' }}</option>
                                <option :value="0">{{ $isGu ? '○ નિષ્ક્રિય (Inactive)' : '○ Inactive' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" @click="editModalOpen = false" class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs transition">
                            {{ $isGu ? 'રદ કરો (Cancel)' : 'Cancel' }}
                        </button>
                        <button type="submit" class="btn-theme-gradient font-black px-6 py-2.5 rounded-xl shadow-md text-xs flex items-center gap-2 hover:scale-105 transition">
                            <i class="fa-solid fa-floppy-disk text-yellow-200"></i>
                            <span>{{ $isGu ? 'ફેરફાર સાચવો (Update)' : 'Save Changes' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
