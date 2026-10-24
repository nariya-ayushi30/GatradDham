@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
@endphp

@section('title', $isGu ? 'આરતી સમય સંચાલન | શ્રી ગાત્રાળ ધામ એડમિન' : 'Aarti Schedule Management | Shree Gatrad Dham Admin')

@section('content')

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-bell text-orange-600"></i>
                <span>{{ $isGu ? 'દૈનિક દર્શન & આરતી સમય સંચાલન' : 'Daily Aarti & Darshan Schedule' }}</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1 font-semibold">
                {{ $isGu ? 'નિત્ય મંગળા, શૃંગાર, રાજભોગ, સંધ્યા અને શયન આરતી સમયપત્રક મેનેજ કરો.' : 'Configure daily Mangla, Shringar, Rajbhog, Sandhya, and Shayan Aarti prayer timings.' }}
            </p>
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
        editModal: false,
        editItem: {},
        openEdit(item) {
            this.editItem = Object.assign({}, item);
            this.editModal = true;
        }
    }">
        
        <!-- Add Aarti Form (Col 4) -->
        <div class="lg:col-span-4 admin-card p-6 shadow-sm">
            <h2 class="text-base font-black text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-plus text-orange-600"></i>
                <span>{{ $isGu ? 'આરતી સમય ઉમેરો' : 'Add Aarti Timing' }}</span>
            </h2>

            <form action="{{ route('admin.aarti.store') }}" method="POST" class="space-y-3.5 text-xs">
                @csrf

                <!-- Aarti Fields (Single Form based on Active Language) -->
                @if($isGu)
                    <!-- GUJARATI ONLY -->
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">આરતી નામ*</label>
                        <input type="text" name="title_gu" required placeholder="દા.ત. મંગળા આરતી" value="{{ old('title_gu') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">સમય*</label>
                            <input type="text" name="time_gu" required placeholder="સવારે ૫:૩૦" value="{{ old('time_gu') }}"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">બેજ (ટેગ)</label>
                            <input type="text" name="badge_gu" placeholder="પ્રાતઃ કાળ" value="{{ old('badge_gu') }}"
                                   class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-800 mb-1">વર્ણન / મહાત્મ્ય</label>
                        <textarea name="desc_gu" rows="2" placeholder="પ્રભાતની પ્રથમ પાવન આરતી..."
                                  class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">{{ old('desc_gu') }}</textarea>
                    </div>
                @else
                    <!-- ENGLISH ONLY -->
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Aarti Name*</label>
                        <input type="text" name="title_en" required placeholder="e.g. Mangla Aarti" value="{{ old('title_en') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">Time*</label>
                            <input type="text" name="time_en" required placeholder="5:30 AM" value="{{ old('time_en') }}"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">Badge (Tag)</label>
                            <input type="text" name="badge_en" placeholder="Morning / Special" value="{{ old('badge_en') }}"
                                   class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-800 mb-1">Description</label>
                        <textarea name="desc_en" rows="2" placeholder="First sacred aarti of the dawn..."
                                  class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">{{ old('desc_en') }}</textarea>
                    </div>
                @endif

                <div>
                    <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'પ્રદર્શિત ક્રમ (Order)' : 'Display Order' }}</label>
                    <input type="number" name="order" value="{{ old('order', 1) }}"
                           class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-bold">
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-400 via-orange-500 to-orange-600 hover:from-amber-500 hover:to-orange-700 text-white font-black text-xs shadow-md transition mt-2 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>{{ $isGu ? '+ આરતી સમયપત્રક સેવ કરો' : '+ Save Aarti Schedule' }}</span>
                </button>
            </form>
        </div>

        <!-- Aarti List (Col 8) -->
        <div class="lg:col-span-8 admin-card p-6 shadow-sm">
            <h2 class="text-base font-black text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-clock text-amber-500"></i>
                <span>{{ $isGu ? 'સક્રિય આરતી સમયપત્રક' : 'Active Aarti Timings' }} ({{ count($aartis) }})</span>
            </h2>

            <div class="space-y-3">
                @forelse($aartis as $item)
                    <div class="p-4 rounded-2xl border-2 border-orange-100 bg-orange-50/20 hover:border-orange-300 transition flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg shrink-0">
                                <i class="fa-solid fa-bell"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    @if($isGu)
                                        <h3 class="font-bold text-slate-900 text-sm">{{ $item->title_gu ?: $item->title_en }}</h3>
                                        @if($item->title_en && $item->title_en !== $item->title_gu)
                                            <span class="text-xs text-slate-500 font-medium">({{ $item->title_en }})</span>
                                        @endif
                                    @else
                                        <h3 class="font-bold text-slate-900 text-sm">{{ $item->title_en ?: $item->title_gu }}</h3>
                                        @if($item->title_gu && $item->title_gu !== $item->title_en)
                                            <span class="text-xs text-slate-500 font-medium">({{ $item->title_gu }})</span>
                                        @endif
                                    @endif

                                    @php
                                        $badge = $isGu ? ($item->badge_gu ?: $item->badge_en) : ($item->badge_en ?: $item->badge_gu);
                                    @endphp
                                    @if($badge)
                                        <span class="text-[9px] font-bold px-2 py-0.5 rounded-md bg-orange-100 text-orange-800 border border-orange-200">
                                            {{ $badge }}
                                        </span>
                                    @endif
                                </div>
                                @php
                                    $desc = $isGu ? ($item->desc_gu ?: $item->desc_en) : ($item->desc_en ?: $item->desc_gu);
                                @endphp
                                @if($desc)
                                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1">
                                        {{ $desc }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <span class="px-3 py-1.5 rounded-xl bg-white border-2 border-orange-200 text-orange-900 font-mono font-bold text-xs shadow-sm">
                                {{ $isGu ? ($item->time_gu ?: $item->time_en) : ($item->time_en ?: $item->time_gu) }}
                            </span>
                            
                            <!-- Edit Button with Icon (Icon Only) -->
                            <button type="button" @click="openEdit({{ json_encode($item) }})" class="w-8 h-8 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 flex items-center justify-center text-xs transition shadow-sm" title="{{ $isGu ? 'એડિટ' : 'Edit' }}">
                                <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.aarti.destroy', $item->id) }}" method="POST" onsubmit="return confirm('{{ $isGu ? 'શું તમે આ આરતી સમયપત્રક ખરેખર ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this Aarti timing?' }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 flex items-center justify-center text-xs transition shadow-sm" title="{{ $isGu ? 'ડિલીટ' : 'Delete' }}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="p-8 text-center text-slate-400 font-bold text-xs">
                        {{ $isGu ? 'હજુ સુધી કોઈ આરતી સમયપત્રક ઉમેરવામાં આવ્યું નથી.' : 'No Aarti timings found. Add a new timing using the form.' }}
                    </p>
                @endforelse
            </div>
        </div>

        <!-- ==================== EDIT AARTI MODAL ==================== -->
        <div x-show="editModal" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto"
             style="display: none;">
            
            <div class="bg-white border-2 border-orange-300 rounded-3xl max-w-lg w-full p-6 shadow-2xl relative my-8" @click.away="editModal = false">
                <button type="button" @click="editModal = false" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700 text-xl">
                    <i class="fa-solid fa-xmark"></i>
                </button>

                <div class="mb-5 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-slate-900">
                            {{ $isGu ? 'આરતી સમયપત્રક એડિટ કરો' : 'Edit Aarti Timing' }}
                        </h2>
                        <p class="text-xs text-slate-500 font-medium">
                            {{ $isGu ? 'આરતીનું નામ, સમય અને વિગતો સુધારો.' : 'Update prayer title, timings and description.' }}
                        </p>
                    </div>
                </div>

                <form :action="'/admin/aarti/' + editItem.id" method="POST" class="space-y-3.5 text-xs">
                    @csrf
                    @method('PUT')

                    @if($isGu)
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">આરતી નામ*</label>
                            <input type="text" name="title_gu" required x-model="editItem.title_gu"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">સમય*</label>
                                <input type="text" name="time_gu" required x-model="editItem.time_gu"
                                       class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">બેજ (ટેગ)</label>
                                <input type="text" name="badge_gu" x-model="editItem.badge_gu"
                                       class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-800 mb-1">વર્ણન / મહાત્મ્ય</label>
                            <textarea name="desc_gu" rows="2" x-model="editItem.desc_gu"
                                      class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900"></textarea>
                        </div>
                    @else
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">Aarti Name*</label>
                            <input type="text" name="title_en" required x-model="editItem.title_en"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">Time*</label>
                                <input type="text" name="time_en" required x-model="editItem.time_en"
                                       class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">Badge (Tag)</label>
                                <input type="text" name="badge_en" x-model="editItem.badge_en"
                                       class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-800 mb-1">Description</label>
                            <textarea name="desc_en" rows="2" x-model="editItem.desc_en"
                                      class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900"></textarea>
                        </div>
                    @endif

                    <div>
                        <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'ક્રમ (Order)' : 'Display Order' }}</label>
                        <input type="number" name="order" x-model="editItem.order"
                               class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-bold">
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" @click="editModal = false" class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs transition">
                            {{ $isGu ? 'રદ કરો' : 'Cancel' }}
                        </button>
                        <button type="submit" class="btn-theme-gradient font-black px-6 py-2.5 rounded-xl shadow-md text-xs flex items-center gap-2 hover:scale-105 transition">
                            <i class="fa-solid fa-floppy-disk text-yellow-200"></i>
                            <span>{{ $isGu ? 'ફેરફાર સાચવો' : 'Update Aarti' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection