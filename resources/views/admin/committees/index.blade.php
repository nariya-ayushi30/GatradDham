@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
@endphp

@section('title', $isGu ? 'સમિતિ સભ્યો સંચાલન | શ્રી ગાત્રાળ ધામ એડમિન' : 'Committee Members | Shree Gatrad Dham Admin')

@section('content')

    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-users text-orange-600"></i>
                <span>{{ $isGu ? 'સમિતિ સભ્યો સંચાલન' : 'Committee Members Management' }}</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1 font-semibold">
                {{ $isGu ? 'ગામ/સમાજ સમિતિ અને મંદિર ટ્રસ્ટ સમિતિના સભ્યો ઉમેરો અને મેનેજ કરો.' : 'Add and manage Village Committee & Temple Trust Committee members.' }}
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
        editMember: {},
        editPreview: null,
        openEdit(item) {
            this.editMember = Object.assign({}, item);
            this.editPreview = null;
            this.editModal = true;
        }
    }">
        
        <!-- Add Member Form (Col 4) -->
        <div class="lg:col-span-4 admin-card p-6 shadow-sm">
            <h2 class="text-base font-black text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user-plus text-orange-600"></i>
                <span>{{ $isGu ? 'સમિતિ સભ્ય ઉમેરો' : 'Add Committee Member' }}</span>
            </h2>

            <form action="{{ route('admin.committees.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3.5 text-xs">
                @csrf

                <!-- 1. Committee Type -->
                <div>
                    <label class="block font-bold text-slate-700 mb-1">
                        {{ $isGu ? 'સમિતિનો પ્રકાર*' : 'Committee Type*' }}
                    </label>
                    <select name="committee_type" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 text-slate-900 font-semibold focus:outline-none focus:border-orange-500">
                        <option value="gam" {{ request('type', 'gam') == 'gam' ? 'selected' : '' }}>
                            {{ $isGu ? 'ગામ / સમાજ સમિતિ' : 'Village Committee' }}
                        </option>
                        <option value="trust" {{ request('type') == 'trust' ? 'selected' : '' }}>
                            {{ $isGu ? 'મંદિર ટ્રસ્ટ સમિતિ' : 'Temple Trust Committee' }}
                        </option>
                    </select>
                </div>

                <!-- 2. Member Name, Designation & Village (Single Form according to Active Language) -->
                @if($isGu)
                    <!-- GUJARATI MODE: Single Gujarati Fields -->
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">
                            સભ્યનું પૂરું નામ*
                        </label>
                        <input type="text" name="name_gu" required placeholder="દા.ત. રમેશભાઈ પટેલ" value="{{ old('name_gu') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">
                                હોદ્દો*
                            </label>
                            <input type="text" name="designation_gu" required placeholder="દા.ત. પ્રમુખશ્રી" value="{{ old('designation_gu') }}"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">
                                ગામ / શહેર
                            </label>
                            <input type="text" name="village_gu" placeholder="દા.ત. અમદાવાદ" value="{{ old('village_gu') }}"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                        </div>
                    </div>
                @else
                    <!-- ENGLISH MODE: Single English Fields -->
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">
                            Full Name*
                        </label>
                        <input type="text" name="name_en" required placeholder="e.g. Rameshbhai Patel" value="{{ old('name_en') }}"
                               class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">
                                Designation*
                            </label>
                            <input type="text" name="designation_en" required placeholder="e.g. President" value="{{ old('designation_en') }}"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">
                                Village / City
                            </label>
                            <input type="text" name="village_en" placeholder="e.g. Ahmedabad" value="{{ old('village_en') }}"
                                   class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                        </div>
                    </div>
                @endif

                <!-- 4. Phone & Display Order -->
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'મોબાઈલ નંબર' : 'Phone Number' }}</label>
                        <input type="text" name="phone" placeholder="+91 98XXXXXXXX" value="{{ old('phone') }}"
                               class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'પ્રદર્શિત ક્રમ' : 'Display Order' }}</label>
                        <input type="number" name="order" value="{{ old('order', 1) }}"
                               class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-bold">
                    </div>
                </div>

                <!-- 5. Real Photo Upload with Preview -->
                <div class="p-3 bg-orange-50/50 rounded-2xl border-2 border-dashed border-orange-200">
                    <label class="block font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-camera text-orange-600"></i>
                        <span>{{ $isGu ? 'સભ્યનો ફોટો અપલોડ કરો (JPG, PNG)' : 'Upload Member Photo (JPG, PNG)' }}</span>
                    </label>
                    <input type="file" name="photo" id="member_photo_input" accept="image/*"
                           onchange="previewMemberPhoto(this)"
                           class="w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-600 file:text-white hover:file:bg-orange-700 cursor-pointer">
                    
                    <!-- Preview Container -->
                    <div id="photo_preview_container" class="mt-2.5 hidden items-center gap-3 p-2 bg-white rounded-xl border border-orange-200">
                        <img id="photo_preview_img" src="#" alt="Preview" class="w-12 h-12 rounded-xl object-cover border border-orange-300">
                        <div class="text-[11px] text-slate-600">
                            <span class="font-bold text-slate-900 block" id="photo_filename">photo.jpg</span>
                            <span class="text-emerald-600 font-semibold"><i class="fa-solid fa-check text-[10px]"></i> {{ $isGu ? 'ફોટો પસંદ થયો' : 'Image selected' }}</span>
                        </div>
                    </div>

                    <!-- Optional URL fallback -->
                    <div class="mt-2 pt-2 border-t border-orange-100">
                        <label class="block text-[11px] text-slate-500 font-medium mb-1">{{ $isGu ? 'અથવા ઓનલાઇન ફોટો લિંક (વૈકલ્પિક):' : 'Or paste online image URL (Optional):' }}</label>
                        <input type="url" name="photo_url" placeholder="https://example.com/photo.jpg" value="{{ old('photo_url') }}"
                               class="w-full bg-white border border-slate-300 rounded-xl px-2.5 py-1.5 text-xs focus:border-orange-500 focus:outline-none">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-400 via-orange-500 to-orange-600 hover:from-amber-500 hover:to-orange-700 text-white font-black text-xs shadow-md transition mt-2 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>{{ $isGu ? '+ સમિતિ સભ્ય સેવ કરો' : '+ Save Committee Member' }}</span>
                </button>
            </form>
        </div>

        <!-- Members Table (Col 8) -->
        <div class="lg:col-span-8 admin-card p-6 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
                <h2 class="text-base font-black text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-address-book text-amber-500"></i>
                    <span>
                        {{ $isGu ? 'હાલના સમિતિ સભ્યો' : 'Registered Members' }}
                        <span class="text-xs text-orange-600 font-bold">({{ $members->total() }})</span>
                    </span>
                </h2>

                <!-- Tabs: Gam / Trust / All -->
                <div class="flex items-center gap-1.5 bg-orange-50/70 p-1 rounded-2xl border border-orange-200 text-xs">
                    <a href="{{ route('admin.committees.index', ['type' => 'gam']) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold transition {{ request('type', 'gam') == 'gam' ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-700 hover:text-orange-600 hover:bg-orange-100/50' }}">
                        {{ $isGu ? 'ગામ/સમાજ સમિતિ' : 'Village Committee' }}
                    </a>
                    <a href="{{ route('admin.committees.index', ['type' => 'trust']) }}" 
                       class="px-3 py-1.5 rounded-xl font-bold transition {{ request('type') == 'trust' ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-700 hover:text-orange-600 hover:bg-orange-100/50' }}">
                        {{ $isGu ? 'ટ્રસ્ટ સમિતિ' : 'Trust Committee' }}
                    </a>
                    <a href="{{ route('admin.committees.index') }}" 
                       class="px-3 py-1.5 rounded-xl font-bold transition {{ !request()->has('type') ? 'bg-orange-600 text-white shadow-sm' : 'text-slate-700 hover:text-orange-600 hover:bg-orange-100/50' }}">
                        {{ $isGu ? 'બધા' : 'All' }}
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-700">
                    <thead class="bg-orange-50 text-orange-950 uppercase font-black text-[10px] border-b-2 border-orange-200">
                        <tr>
                            <th class="p-3">{{ $isGu ? 'ફોટો' : 'Photo' }}</th>
                            <th class="p-3">{{ $isGu ? 'સભ્ય વિગત' : 'Member Details' }}</th>
                            <th class="p-3">{{ $isGu ? 'હોદ્દો' : 'Designation' }}</th>
                            <th class="p-3">{{ $isGu ? 'સમિતિ' : 'Committee' }}</th>
                            <th class="p-3 text-center">{{ $isGu ? 'એક્શન' : 'Action' }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($members as $m)
                            <tr class="hover:bg-orange-50/40 transition">
                                <td class="p-3">
                                    <div class="w-12 h-12 rounded-2xl overflow-hidden border-2 border-orange-200 bg-orange-50/50 shadow-sm shrink-0">
                                        @if(!empty($m->photo_url) && !str_contains($m->photo_url, 'admin/committees'))
                                            <img src="{{ $m->photo_url }}" alt="{{ $m->name_en }}" class="w-full h-full object-cover"
                                                 onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-orange-500 font-bold bg-orange-50\'><i class=\'fa-solid fa-user text-sm\'></i></div>'">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-orange-500 font-bold bg-orange-50">
                                                <i class="fa-solid fa-user text-sm"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-3">
                                    <span class="font-bold text-slate-900 block text-xs">{{ $isGu ? ($m->name_gu ?: $m->name_en) : ($m->name_en ?: $m->name_gu) }}</span>
                                    @if($m->phone)
                                        <span class="text-[10px] text-slate-400 font-mono block"><i class="fa-solid fa-phone mr-1 text-[9px]"></i>{{ $m->phone }}</span>
                                    @endif
                                    @php
                                        $village = $isGu ? ($m->village_gu ?: $m->village_en) : ($m->village_en ?: $m->village_gu);
                                    @endphp
                                    @if($village)
                                        <span class="text-[10px] text-orange-700 block font-semibold"><i class="fa-solid fa-location-dot mr-1 text-[9px]"></i>{{ $village }}</span>
                                    @endif
                                </td>
                                <td class="p-3">
                                    <span class="font-bold text-orange-700 bg-yellow-100 px-2.5 py-1 rounded-lg text-[10px] border border-yellow-300 inline-block">
                                        {{ $isGu ? ($m->designation_gu ?: $m->designation_en) : ($m->designation_en ?: $m->designation_gu) }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-lg border {{ $m->committee_type == 'trust' ? 'bg-orange-50 text-orange-800 border-orange-200' : 'bg-amber-50 text-amber-800 border-amber-200' }}">
                                        @if($isGu)
                                            {{ $m->committee_type == 'trust' ? 'ટ્રસ્ટ સમિતિ' : 'ગામ સમિતિ' }}
                                        @else
                                            {{ $m->committee_type == 'trust' ? 'Trust Committee' : 'Village Committee' }}
                                        @endif
                                    </span>
                                </td>
                                <td class="p-3 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" @click="openEdit({{ json_encode($m) }})" class="w-7 h-7 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-300 flex items-center justify-center text-xs transition shadow-sm" title="{{ $isGu ? 'એડિટ' : 'Edit' }}">
                                            <i class="fa-solid fa-pen-to-square text-amber-600"></i>
                                        </button>
                                        <form action="{{ route('admin.committees.destroy', $m->id) }}" method="POST" onsubmit="return confirm('{{ $isGu ? 'શું તમે આ સભ્યને ખરેખર ડિલીટ કરવા માંગો છો?' : 'Are you sure you want to delete this member?' }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-7 h-7 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 flex items-center justify-center text-xs transition shadow-sm" title="{{ $isGu ? 'ડિલીટ' : 'Delete' }}">
                                                <i class="fa-solid fa-trash-can text-rose-500"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400 font-bold">
                                    {{ $isGu ? 'આ કેટેગરીમાં કોઈ સમિતિ સભ્યો મળ્યા નથી.' : 'No committee members found in this category.' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $members->links() }}
            </div>
        </div>

        <!-- ==================== EDIT COMMITTEE MEMBER MODAL ==================== -->
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
                        <i class="fa-solid fa-people-roof"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-black text-slate-900">
                            {{ $isGu ? 'સમિતિ સભ્ય એડિટ કરો' : 'Edit Committee Member' }}
                        </h2>
                        <p class="text-xs text-slate-500 font-medium">
                            {{ $isGu ? 'સભ્યનું નામ, હોદ્દો, ગામ અથવા ફોટો સુધારો.' : 'Update member name, designation or photo.' }}
                        </p>
                    </div>
                </div>

                <form :action="'/admin/committees/' + editMember.id" method="POST" enctype="multipart/form-data" class="space-y-3.5 text-xs">
                    @csrf
                    @method('PUT')

                    <!-- Committee Type -->
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">{{ $isGu ? 'સમિતિનો પ્રકાર*' : 'Committee Type*' }}</label>
                        <select name="committee_type" x-model="editMember.committee_type" required class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 text-slate-900 font-semibold focus:outline-none focus:border-orange-500">
                            <option value="trust">{{ $isGu ? 'શ્રી ગાત્રાળ માતાજી મંદિર ટ્રસ્ટ સમિતિ' : 'Trust Committee' }}</option>
                            <option value="gam">{{ $isGu ? 'ગામ & સમાજ સમિતિ' : 'Village & Community Committee' }}</option>
                        </select>
                    </div>

                    @if($isGu)
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">સભ્યનું પૂરું નામ*</label>
                            <input type="text" name="name_gu" required x-model="editMember.name_gu" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">હોદ્દો*</label>
                                <input type="text" name="designation_gu" required x-model="editMember.designation_gu" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">ગામ / શહેર</label>
                                <input type="text" name="village_gu" x-model="editMember.village_gu" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                            </div>
                        </div>
                    @else
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">Member Full Name*</label>
                            <input type="text" name="name_en" required x-model="editMember.name_en" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">Designation*</label>
                                <input type="text" name="designation_en" required x-model="editMember.designation_en" class="w-full bg-white border-2 border-orange-200 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-medium">
                            </div>
                            <div>
                                <label class="block font-bold text-slate-800 mb-1">Village / City</label>
                                <input type="text" name="village_en" x-model="editMember.village_en" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                            </div>
                        </div>
                    @endif

                    <!-- Phone & Order -->
                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'મોબાઈલ નંબર' : 'Phone Number' }}</label>
                            <input type="text" name="phone" x-model="editMember.phone" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-800 mb-1">{{ $isGu ? 'પ્રદર્શિત ક્રમ' : 'Display Order' }}</label>
                            <input type="number" name="order" x-model="editMember.order" class="w-full bg-white border border-slate-300 rounded-xl px-3 py-2 focus:border-orange-500 focus:outline-none text-slate-900 font-bold">
                        </div>
                    </div>

                    <!-- Photo Upload -->
                    <div class="p-3 bg-orange-50/50 rounded-2xl border-2 border-dashed border-orange-200">
                        <label class="block font-bold text-slate-800 mb-1.5 flex items-center justify-between">
                            <span class="flex items-center gap-1.5">
                                <i class="fa-solid fa-camera text-orange-600"></i>
                                <span>{{ $isGu ? 'સભ્યનો ફોટો બદલો' : 'Change Member Photo' }}</span>
                            </span>
                            <span class="text-[10px] text-slate-500">{{ $isGu ? '(ખાલી રાખશો તો જૂનો રહેશે)' : '(Leave empty to keep)' }}</span>
                        </label>
                        
                        <div class="flex items-center gap-3 mb-2 p-1.5 bg-white rounded-xl border border-orange-200">
                            <img :src="editPreview || editMember.photo_url || '/images/default-avatar.png'" class="w-10 h-10 rounded-full object-cover border border-orange-300" alt="Current image">
                            <div class="text-[10px] text-slate-500 truncate" x-text="editPreview ? 'નવો ફોટો પસંદ થયો' : (editMember.photo_url || 'કોઈ ફોટો નથી')"></div>
                        </div>

                        <input type="file" name="photo" accept="image/*"
                               @change="editPreview = URL.createObjectURL($event.target.files[0])"
                               class="w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-600 file:text-white hover:file:bg-orange-700 cursor-pointer">
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                        <button type="button" @click="editModal = false" class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs transition">
                            {{ $isGu ? 'રદ કરો' : 'Cancel' }}
                        </button>
                        <button type="submit" class="btn-theme-gradient font-black px-6 py-2.5 rounded-xl shadow-md text-xs flex items-center gap-2 hover:scale-105 transition">
                            <i class="fa-solid fa-floppy-disk text-yellow-200"></i>
                            <span>{{ $isGu ? 'ફેરફાર સાચવો' : 'Save Changes' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
<script>
    function previewMemberPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('photo_preview_img');
                const container = document.getElementById('photo_preview_container');
                const filename = document.getElementById('photo_filename');
                
                if (img && container) {
                    img.src = e.target.result;
                    filename.textContent = input.files[0].name;
                    container.classList.remove('hidden');
                    container.classList.add('flex');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush