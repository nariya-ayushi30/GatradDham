@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
@endphp

@section('title', $isGu ? 'ટ્રસ્ટ સેવા પ્રવૃત્તિઓ | શ્રી ગાત્રાળ ધામ એડમિન' : 'Trust Seva Activities | Shree Gatrad Dham Admin')

@section('content')

    <div class="space-y-6" x-data="{ 
        addModal: false, 
        editModal: false, 
        editItem: {}, 
        editPreview: null,
        openEdit(item) { 
            this.editItem = Object.assign({}, item); 
            this.editPreview = null; 
            this.editModal = true; 
        } 
    }">
        
        <!-- Header & Action Button -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-md">
            <div>
                <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-3.5 py-1 rounded-full border border-yellow-400">
                    {{ $isGu ? 'સેવાકીય પ્રકલ્પો' : 'SEVA INITIATIVES' }}
                </span>
                <h1 class="text-2xl font-black text-slate-900 mt-2">
                    {{ $isGu ? 'ટ્રસ્ટ સેવા પ્રવૃત્તિઓ સંચાલન' : 'Trust Seva Activities Management' }}
                </h1>
                <p class="text-xs text-slate-600 mt-1">
                    {{ $isGu ? 'અન્નક્ષેત્ર મહાપ્રસાદ, ગૌશાળા, મેડિકલ કેમ્પ અને અન્ય સેવાકીય પ્રકલ્પોનું સંચાલન કરો.' : 'Manage Annakshetra Mahaprasad, Gaushala, Medical Camps, and charitable activities.' }}
                </p>
            </div>

            <button type="button" @click="addModal = true" class="btn-theme-gradient font-black px-6 py-3 rounded-2xl text-xs flex items-center justify-center gap-2 shadow-lg shrink-0">
                <i class="fa-solid fa-plus text-yellow-200"></i>
                <span>{{ $isGu ? '+ નવું પ્રકલ્પ ઉમેરો' : '+ Add Activity' }}</span>
            </button>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-2xl bg-emerald-50 border-2 border-emerald-300 text-xs font-bold text-emerald-800 flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-emerald-600 text-base"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div class="p-4 rounded-2xl bg-rose-100 border border-rose-300 text-rose-800 text-xs font-bold space-y-1">
                @foreach($errors->all() as $err)
                    <p><i class="fa-solid fa-triangle-exclamation mr-1"></i> {{ $err }}</p>
                @endforeach
            </div>
        @endif

        <!-- Activities List Table -->
        <div class="bg-white border-2 border-orange-200 rounded-3xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-orange-50 to-amber-50/50 border-b-2 border-orange-200 text-orange-950 font-black">
                            <th class="py-4 px-5">{{ $isGu ? 'આઈકોન' : 'Icon' }}</th>
                            <th class="py-4 px-5">{{ $isGu ? 'શીર્ષક' : 'Title' }}</th>
                            <th class="py-4 px-5">{{ $isGu ? 'સબટાઇટલ' : 'Subtitle' }}</th>
                            <th class="py-4 px-5">{{ $isGu ? 'આંકડા' : 'Stats' }}</th>
                            <th class="py-4 px-5">{{ $isGu ? 'ફોટો' : 'Image' }}</th>
                            <th class="py-4 px-5 text-right">{{ $isGu ? 'એક્શન' : 'Action' }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($activities as $act)
                            <tr class="hover:bg-orange-50/40 transition">
                                <td class="py-4 px-5">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-400 to-orange-500 text-white flex items-center justify-center text-lg shadow-sm">
                                        <i class="fa-solid {{ $act->icon }}"></i>
                                    </div>
                                </td>
                                <td class="py-4 px-5">
                                    @if($isGu)
                                        <div class="font-bold text-slate-900 text-sm">{{ $act->title_gu ?: $act->title_en }}</div>
                                        @if($act->title_en && $act->title_en !== $act->title_gu)
                                            <div class="text-[11px] text-orange-700 font-semibold">{{ $act->title_en }}</div>
                                        @endif
                                    @else
                                        <div class="font-bold text-slate-900 text-sm">{{ $act->title_en ?: $act->title_gu }}</div>
                                        @if($act->title_gu && $act->title_gu !== $act->title_en)
                                            <div class="text-[11px] text-orange-700 font-semibold">{{ $act->title_gu }}</div>
                                        @endif
                                    @endif
                                </td>
                                <td class="py-4 px-5 text-slate-600">
                                    @if($isGu)
                                        <div>{{ $act->subtitle_gu ?: $act->subtitle_en }}</div>
                                    @else
                                        <div>{{ $act->subtitle_en ?: $act->subtitle_gu }}</div>
                                    @endif
                                </td>
                                <td class="py-4 px-5">
                                    @php
                                        $stats = $isGu ? ($act->stats_gu ?: $act->stats_en) : ($act->stats_en ?: $act->stats_gu);
                                    @endphp
                                    @if($stats)
                                        <span class="px-2.5 py-1 rounded-full bg-yellow-100 text-orange-800 font-bold border border-yellow-300 text-[10px]">
                                            {{ $stats }}
                                        </span>
                                    @else
                                        <span class="text-slate-400 text-[10px]">-</span>
                                    @endif
                                </td>
                                <td class="py-4 px-5">
                                    @if($act->image_url)
                                        <img src="{{ $act->image_url }}" alt="{{ $act->title_en }}" class="w-14 h-10 object-cover rounded-lg border border-orange-200">
                                    @endif
                                </td>
                                <td class="py-4 px-5 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button" @click="openEdit({{ json_encode($act) }})" class="w-7 h-7 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 flex items-center justify-center text-xs transition shadow-sm" title="{{ $isGu ? 'એડિટ' : 'Edit' }}">
                                            <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                                        </button>
                                        <form action="{{ route('admin.trust.destroy', $act->id) }}" method="POST" onsubmit="return confirm('{{ $isGu ? 'શું તમે આ પ્રકલ્પ ખરેખર ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this activity?' }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-7 h-7 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 flex items-center justify-center text-xs transition shadow-sm" title="{{ $isGu ? 'ડિલીટ' : 'Delete' }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-slate-400 font-bold">
                                    {{ $isGu ? 'હાલમાં કોઈ સેવા પ્રકલ્પ નોંધાયેલ નથી.' : 'No trust activities registered yet.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $activities->links() }}
            </div>
        </div>

        <!-- Add Modal (Bilingual Form) -->
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

                <div class="mb-5">
                    <span class="text-xs font-black text-orange-700 uppercase bg-yellow-200 px-3 py-1 rounded-full border border-yellow-400">
                        {{ $isGu ? 'નવી એન્ટ્રી' : 'NEW ENTRY' }}
                    </span>
                    <h2 class="text-xl font-black text-slate-900 mt-2">
                        {{ $isGu ? 'નવું સેવા પ્રકલ્પ ઉમેરો' : 'Add New Seva Activity' }}
                    </h2>
                </div>

                <form action="{{ route('admin.trust.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- Activity Form Fields (Single Clean Form based on Active Language) -->
                    @if($isGu)
                        <!-- GUJARATI MODE -->
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">પ્રવૃત્તિ શીર્ષક*</label>
                            <input type="text" name="title_gu" placeholder="દા.ત. નિઃશુલ્ક તબીબી કેમ્પ" required value="{{ old('title_gu') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">સબટાઇટલ</label>
                            <input type="text" name="subtitle_gu" placeholder="દા.ત. દર માસે વિનામૂલ્યે આરોગ્ય તપાસ" value="{{ old('subtitle_gu') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">વિગત / વર્ણન*</label>
                            <textarea name="description_gu" rows="3" required placeholder="પ્રકલ્પની સંપૂર્ણ વિગત ગુજરાતીમાં..." class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">{{ old('description_gu') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1">FontAwesome આઈકોન</label>
                                <input type="text" name="icon" value="{{ old('icon', 'fa-hand-holding-heart') }}" placeholder="fa-bowl-food" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1">આંકડા (Stats)</label>
                                <input type="text" name="stats_gu" placeholder="દા.ત. ૫,૦૦૦+ લાભાર્થીઓ" value="{{ old('stats_gu') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                        </div>
                    @else
                        <!-- ENGLISH MODE -->
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">Activity Title*</label>
                            <input type="text" name="title_en" placeholder="e.g. Free Medical Camp" required value="{{ old('title_en') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">Subtitle</label>
                            <input type="text" name="subtitle_en" placeholder="e.g. Monthly free health checkup" value="{{ old('subtitle_en') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">Detailed Description*</label>
                            <textarea name="description_en" rows="3" required placeholder="Detailed activity description in English..." class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">{{ old('description_en') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1">FontAwesome Icon</label>
                                <input type="text" name="icon" value="{{ old('icon', 'fa-hand-holding-heart') }}" placeholder="fa-bowl-food" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1">Stats (e.g. 5,000+ Beneficiaries)</label>
                                <input type="text" name="stats_en" placeholder="e.g. 5,000+ Beneficiaries" value="{{ old('stats_en') }}" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                        </div>
                    @endif

                    <!-- Image Upload -->
                    <div class="p-3 bg-orange-50/50 rounded-2xl border-2 border-dashed border-orange-200">
                        <label class="block text-xs font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                            <i class="fa-solid fa-camera text-orange-600"></i>
                            <span>{{ $isGu ? 'પ્રકલ્પ ફોટો અપલોડ કરો (JPG, PNG)' : 'Upload Activity Image (JPG, PNG)' }}</span>
                        </label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-600 file:text-white hover:file:bg-orange-700 cursor-pointer">
                        
                        <div class="mt-2 pt-2 border-t border-orange-100">
                            <label class="block text-[11px] text-slate-500 font-medium mb-1">{{ $isGu ? 'અથવા ઓનલાઇન ફોટો લિંક:' : 'Or paste online image URL:' }}</label>
                            <input type="url" name="image_url" placeholder="https://images.unsplash.com/..." class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-1.5 text-xs text-slate-900 focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                        <button type="button" @click="addModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                            {{ $isGu ? 'રદ કરો' : 'Cancel' }}
                        </button>
                        <button type="submit" class="btn-theme-gradient font-black px-6 py-2.5 rounded-xl text-xs shadow-md">
                            {{ $isGu ? '+ પ્રકલ્પ સેવ કરો' : '+ Save Activity' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- ==================== EDIT ACTIVITY MODAL ==================== -->
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
                    <div class="w-10 h-10 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-900">
                            {{ $isGu ? 'સેવા પ્રકલ્પ એડિટ કરો' : 'Edit Seva Activity' }}
                        </h2>
                        <p class="text-xs text-slate-500 font-medium">
                            {{ $isGu ? 'પ્રકલ્પની વિગત, સ્ટેટ્સ અથવા ફોટો સુધારો.' : 'Update activity details, stats or photo.' }}
                        </p>
                    </div>
                </div>

                <form :action="'/admin/trust/' + editItem.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    @if($isGu)
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">પ્રવૃત્તિ શીર્ષક*</label>
                            <input type="text" name="title_gu" required x-model="editItem.title_gu" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">સબટાઇટલ</label>
                            <input type="text" name="subtitle_gu" x-model="editItem.subtitle_gu" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">વિગત / વર્ણન*</label>
                            <textarea name="description_gu" rows="3" required x-model="editItem.description_gu" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm"></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1">સ્ટેટ્સ બેજ (Stats)</label>
                                <input type="text" name="stats_gu" x-model="editItem.stats_gu" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1">આઇકન ક્લાસ (FontAwesome)</label>
                                <input type="text" name="icon" x-model="editItem.icon" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                        </div>
                    @else
                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">Activity Title*</label>
                            <input type="text" name="title_en" required x-model="editItem.title_en" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">Subtitle</label>
                            <input type="text" name="subtitle_en" x-model="editItem.subtitle_en" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-800 mb-1">Description*</label>
                            <textarea name="description_en" rows="3" required x-model="editItem.description_en" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm"></textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1">Key Statistic (Stats)</label>
                                <input type="text" name="stats_en" x-model="editItem.stats_en" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1">FontAwesome Icon Class</label>
                                <input type="text" name="icon" x-model="editItem.icon" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3.5 py-2.5 text-xs text-slate-900 font-semibold focus:outline-none focus:border-orange-500 shadow-sm">
                            </div>
                        </div>
                    @endif

                    <!-- Image Upload -->
                    <div class="p-3 bg-orange-50/50 rounded-2xl border-2 border-dashed border-orange-200">
                        <label class="block text-xs font-bold text-slate-800 mb-1.5 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-solid fa-camera text-orange-600"></i>
                                <span>{{ $isGu ? 'પ્રકલ્પ ફોટો બદલો' : 'Change Activity Photo' }}</span>
                            </span>
                            <span class="text-[10px] text-slate-500">{{ $isGu ? '(ખાલી રાખશો તો જૂનો રહેશે)' : '(Leave empty to keep current)' }}</span>
                        </label>
                        
                        <div class="flex items-center gap-3 mb-2 p-1.5 bg-white rounded-xl border border-orange-200">
                            <img :src="editPreview || editItem.image_url" class="w-14 h-10 rounded-lg object-cover border border-orange-300" alt="Current image">
                            <div class="text-[10px] text-slate-500 truncate" x-text="editPreview ? 'નવો ફોટો પસંદ થયો' : editItem.image_url"></div>
                        </div>

                        <input type="file" name="image" accept="image/*"
                               @change="editPreview = URL.createObjectURL($event.target.files[0])"
                               class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-600 file:text-white hover:file:bg-orange-700 cursor-pointer">
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t border-slate-100">
                        <button type="button" @click="editModal = false" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 hover:bg-slate-50 transition">
                            {{ $isGu ? 'રદ કરો' : 'Cancel' }}
                        </button>
                        <button type="submit" class="btn-theme-gradient font-black px-6 py-2.5 rounded-xl text-xs shadow-md flex items-center gap-2">
                            <i class="fa-solid fa-floppy-disk text-yellow-200"></i>
                            <span>{{ $isGu ? 'ફેરફાર સાચવો' : 'Save Changes' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection