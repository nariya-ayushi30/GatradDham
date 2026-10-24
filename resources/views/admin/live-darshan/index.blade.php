@extends('admin.layouts.master')

@php
    $isGu = app()->getLocale() === 'gu';
    
    // Prepare full YouTube URL for display
    $currentYtUrl = '';
    if ($live && !empty($live->youtube_embed_id)) {
        $raw = trim($live->youtube_embed_id);
        if (str_starts_with($raw, 'http://') || str_starts_with($raw, 'https://')) {
            $currentYtUrl = $raw;
        } elseif (strlen($raw) === 11) {
            $currentYtUrl = 'https://www.youtube.com/watch?v=' . $raw;
        } else {
            $currentYtUrl = $raw;
        }
    }

    $currentImg = $live ? $live->today_shringar_image : '/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg';
@endphp

@section('title', $isGu ? 'લાઈવ દર્શન & શૃંગાર સેટિંગ્સ | શ્રી ગાત્રાળ ધામ એડમિન' : 'Live Darshan Settings | Shree Gatrad Dham Admin')

@section('content')

    <div x-data="{ 
        videoUrl: '{{ old('youtube_embed_id', $currentYtUrl) }}',
        imageUrl: '{{ old('today_shringar_image', $currentImg) }}',
        previewUrl: '{{ old('today_shringar_image', $currentImg) }}',
        hasNewFile: false,

        selectPreset(url) {
            this.imageUrl = url;
            this.previewUrl = url;
            this.hasNewFile = false;
            let fileInput = document.getElementById('shringar_photo_input');
            if (fileInput) fileInput.value = '';
        },

        handleFileChange(event) {
            if (event.target.files && event.target.files[0]) {
                this.previewUrl = URL.createObjectURL(event.target.files[0]);
                this.hasNewFile = true;
            }
        },

        handleUrlChange() {
            if (this.imageUrl && this.imageUrl.trim() !== '') {
                this.previewUrl = this.imageUrl.trim();
                this.hasNewFile = false;
            }
        },

        extractId(input) {
            if (!input) return '';
            var m = input.match(/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=|live\/|shorts\/))([\w-]{11})/);
            if (m) return m[1];
            var trimmed = input.trim();
            return (trimmed.length === 11 && !trimmed.includes(' ') && !trimmed.includes('/')) ? trimmed : '';
        }
    }">
        <!-- Top Page Header -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 flex items-center gap-2.5">
                    <span class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-red-600 via-rose-500 to-orange-500 text-white flex items-center justify-center text-lg shadow-md shadow-red-500/20">
                        <i class="fa-solid fa-video"></i>
                    </span>
                    <span>{{ $isGu ? 'લાઈવ દર્શન અને શૃંગાર વ્યવસ્થાપન' : 'Live Darshan & Shringar Management' }}</span>
                </h1>
                <p class="text-xs text-slate-500 mt-1 font-semibold">
                    {{ $isGu ? 'વિડીયોની YouTube URL અને આજના શૃંગાર દર્શનનો ફોટો (ફાઈલ, લિંક કે ગેલેરીમાંથી) અહીંથી સેટ કરો.' : 'Manage live streaming YouTube URL and daily shringar darshan photo.' }}
                </p>
            </div>
            
            <a href="{{ route('live.darshan') }}" target="_blank" 
               class="self-start sm:self-center px-4 py-2.5 rounded-xl bg-orange-50 hover:bg-orange-100 text-orange-800 font-bold text-xs flex items-center gap-2 border border-orange-200 transition shadow-sm">
                <i class="fa-solid fa-arrow-up-right-from-square text-orange-600"></i>
                <span>{{ $isGu ? 'લાઈવ પેજ જુઓ' : 'View Live Page' }}</span>
            </a>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border-2 border-emerald-400 text-emerald-900 text-xs font-bold flex items-center gap-3 shadow-md">
                <i class="fa-solid fa-circle-check text-xl text-emerald-600 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Error Alert -->
        @if(isset($errors) && $errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-rose-50 border-2 border-rose-400 text-rose-900 text-xs font-bold shadow-md space-y-1">
                <div class="flex items-center gap-2 text-rose-700 font-black">
                    <i class="fa-solid fa-triangle-exclamation text-base"></i>
                    <span>{{ $isGu ? 'કૃપા કરીને નીચેની ભૂલ સુધારો:' : 'Please fix the following errors:' }}</span>
                </div>
                <ul class="list-disc list-inside text-rose-800 font-semibold pl-2">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
            
            <!-- Left Form Column (Col 7) -->
            <div class="lg:col-span-7">
                
                <form action="{{ route('admin.live-darshan.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- ============================================== -->
                    <!-- 1. YOUTUBE VIDEO URL CARD                      -->
                    <!-- ============================================== -->
                    <div class="bg-white border-2 border-red-200 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-red-600 via-rose-500 to-orange-500"></div>

                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-red-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-9 h-9 rounded-xl bg-red-600 text-white flex items-center justify-center text-base shadow-sm">
                                    <i class="fa-brands fa-youtube"></i>
                                </span>
                                <div>
                                    <h2 class="text-sm font-black text-slate-900">
                                        {{ $isGu ? '૧. YouTube વિડીયો URL' : '1. YouTube Video URL' }}
                                    </h2>
                                    <p class="text-[11px] text-slate-500 font-medium">
                                        {{ $isGu ? 'વિડીયો કે લાઈવની કોઈપણ લિંક પેસ્ટ કરો' : 'Paste any video or live stream YouTube URL' }}
                                    </p>
                                </div>
                            </div>

                            <template x-if="extractId(videoUrl)">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 border border-emerald-300 text-emerald-800 text-[11px] font-bold">
                                    <span class="w-2 h-2 rounded-full bg-emerald-600 animate-pulse"></span>
                                    <span>{{ $isGu ? 'લિંક માન્ય છે' : 'Valid Link' }}</span>
                                </span>
                            </template>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs font-bold text-slate-800 mb-1.5 flex items-center gap-1.5">
                                    <span>{{ $isGu ? 'YouTube વિડીયો લિંક:' : 'YouTube Video URL:' }}</span>
                                    <span class="text-red-500">*</span>
                                </label>
                                
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-red-600 text-base">
                                        <i class="fa-solid fa-link"></i>
                                    </div>
                                    <input type="text" 
                                           name="youtube_embed_id" 
                                           x-model="videoUrl" 
                                           placeholder="https://www.youtube.com/watch?v=lr6pXynt2pQ"
                                           class="w-full bg-white hover:bg-red-50/20 focus:bg-white border-2 border-red-200 focus:border-red-500 rounded-xl pl-10 pr-3.5 py-3 text-xs font-mono text-slate-900 font-bold focus:outline-none transition shadow-sm">
                                </div>
                            </div>

                            <p class="text-[11px] text-slate-500 leading-relaxed">
                                💡 {{ $isGu ? 'ગમે તે YouTube લિંક ચાલશે (જેમ કે: https://www.youtube.com/watch?v=... અથવા https://youtu.be/... અથવા Live લિંક). સિસ્ટમ આપોઆપ સેટ કરી દેશે.' : 'Any YouTube link will work. The system extracts the stream automatically.' }}
                            </p>

                            <!-- Live Broadcast Active Checkbox -->
                            <div class="pt-2 border-t border-red-100 flex items-center gap-2.5">
                                <input type="checkbox" id="is_live" name="is_live" value="1" {{ ($live && $live->is_live) ? 'checked' : '' }}
                                       class="w-4 h-4 text-red-600 rounded cursor-pointer border-slate-300 focus:ring-red-500">
                                <label for="is_live" class="text-xs font-bold text-slate-800 cursor-pointer select-none">
                                    {{ $isGu ? 'આ વિડીયો વેબસાઇટ પર લાઈવ (Active) રાખો' : 'Keep this video active on the website' }}
                                </label>
                            </div>
                        </div>
                    </div>


                    <!-- ============================================== -->
                    <!-- 2. SHRINGAR DARSHAN PHOTO CARD (ANY SOURCE)    -->
                    <!-- ============================================== -->
                    <div class="bg-white border-2 border-amber-200 rounded-3xl p-6 shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-400 via-orange-500 to-amber-500"></div>

                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-amber-100">
                            <div class="flex items-center gap-2.5">
                                <span class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center text-base shadow-sm">
                                    <i class="fa-solid fa-camera"></i>
                                </span>
                                <div>
                                    <h2 class="text-sm font-black text-slate-900">
                                        {{ $isGu ? '૨. આજનો શૃંગાર દર્શન ફોટો' : "2. Today's Shringar Darshan Photo" }}
                                    </h2>
                                    <p class="text-[11px] text-slate-500 font-medium">
                                        {{ $isGu ? 'ગમે ત્યાંથી ફોટો ઉમેરો - ફાઈલ અપલોડ, ઓનલાઇન લિંક અથવા ગેલેરીમાંથી' : 'Add photo from anywhere: file upload, online URL, or temple gallery' }}
                                    </p>
                                </div>
                            </div>

                            <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-black uppercase tracking-wider border border-emerald-300">
                                ✓ ઓટો-સેવ
                            </span>
                        </div>

                        <div class="space-y-4">
                            
                            <!-- WAY A: File Upload (From Mobile / PC) -->
                            <div class="p-4 bg-gradient-to-b from-amber-50/70 to-orange-50/40 rounded-2xl border-2 border-dashed border-amber-300 hover:border-amber-400 transition">
                                <label class="block text-xs font-bold text-slate-800 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-cloud-arrow-up text-amber-600"></i>
                                    <span>{{ $isGu ? 'રીત ૧: મોબાઈલ કે કમ્પ્યુટરમાંથી નવો ફોટો અપલોડ કરો:' : 'Option 1: Upload photo from mobile or computer:' }}</span>
                                </label>
                                <p class="text-[11px] text-slate-500 mb-2.5">
                                    {{ $isGu ? 'કોઈપણ સાઈઝ કે ફોર્મેટનો ફોટો સિલેક્ટ કરો (JPG, PNG, JPEG)' : 'Select photo in any standard format' }}
                                </p>

                                <input type="file" 
                                       name="shringar_photo" 
                                       accept="image/*" 
                                       id="shringar_photo_input"
                                       @change="handleFileChange($event)"
                                       class="w-full text-xs text-slate-700 file:mr-3 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-gradient-to-r file:from-amber-500 file:to-orange-500 file:text-white hover:file:from-amber-600 hover:file:to-orange-600 cursor-pointer shadow-sm">
                            </div>

                            <!-- WAY B: Online Image URL -->
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                                <label class="block text-xs font-bold text-slate-800 mb-1 flex items-center gap-1.5">
                                    <i class="fa-solid fa-globe text-blue-600"></i>
                                    <span>{{ $isGu ? 'રીત ૨: અથવા ઓનલાઇન કોઈપણ ફોટો લિંક (Image URL) પેસ્ટ કરો:' : 'Option 2: Or paste any Online Image URL:' }}</span>
                                </label>
                                <div class="relative mt-1.5">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400 text-xs">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                    <input type="text" 
                                           name="today_shringar_image" 
                                           x-model="imageUrl" 
                                           @input="handleUrlChange()"
                                           placeholder="https://.../shringar_photo.jpg"
                                           class="w-full bg-white border border-slate-300 rounded-xl pl-9 pr-3 py-2 text-xs focus:border-amber-500 focus:outline-none font-mono">
                                </div>
                                <p class="text-[10px] text-slate-500 mt-1">
                                    {{ $isGu ? '💡 જો તમે ઈન્ટરનેટ પરથી લિંક નાખશો તો સિસ્ટમ આપોઆપ તેને ડાઉનલોડ કરીને હંમેશા માટે સેવ કરી લેશે.' : 'External images are automatically downloaded and saved permanently on the server.' }}
                                </p>
                            </div>

                            <!-- WAY C: Preset Authentic Temple Shringar Photos (1-Click) -->
                            @if(!empty($presetShringars))
                                <div class="p-4 bg-orange-50/60 rounded-2xl border border-orange-200">
                                    <label class="block text-xs font-bold text-slate-800 mb-1 flex items-center justify-between">
                                        <span class="flex items-center gap-1.5">
                                            <i class="fa-solid fa-sparkles text-orange-600"></i>
                                            <span>{{ $isGu ? 'રીત ૩: શ્રી ગાત્રાળ માંના અસલ શૃંગાર દર્શનમાંથી ૧-ક્લિકમાં પસંદ કરો:' : 'Option 3: Quick Select from Authentic Darshan Photos:' }}</span>
                                        </span>
                                        <span class="text-[10px] text-orange-700 font-bold bg-orange-100 px-2 py-0.5 rounded-full">
                                            {{ $isGu ? '૧-ક્લિક પસંદગી' : '1-Click' }}
                                        </span>
                                    </label>
                                    <p class="text-[11px] text-slate-500 mb-3">
                                        {{ $isGu ? 'નીચેના કોઈપણ દિવ્ય શૃંગાર ફોટા પર ક્લિક કરતાં તે તરત જ સિલેક્ટ થઈ જશે:' : 'Click any photo below to instantly set as today’s darshan:' }}
                                    </p>

                                    <div class="grid grid-cols-3 sm:grid-cols-6 gap-2.5">
                                        @foreach($presetShringars as $preset)
                                            <button type="button" 
                                                    @click="selectPreset('{{ $preset['url'] }}')"
                                                    class="group relative aspect-square rounded-xl overflow-hidden border-2 transition transform hover:scale-105 cursor-pointer shadow-sm"
                                                    :class="previewUrl === '{{ $preset['url'] }}' ? 'border-orange-500 ring-4 ring-orange-400/30' : 'border-slate-200 hover:border-orange-300'">
                                                <img src="{{ $preset['url'] }}" alt="{{ $isGu ? $preset['title_gu'] : $preset['title_en'] }}" class="w-full h-full object-cover">
                                                
                                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 to-transparent p-1 text-[9px] text-white font-bold text-center truncate">
                                                    {{ $isGu ? $preset['title_gu'] : $preset['title_en'] }}
                                                </div>

                                                <template x-if="previewUrl === '{{ $preset['url'] }}'">
                                                    <div class="absolute top-1 right-1 w-4 h-4 rounded-full bg-orange-600 text-white flex items-center justify-center text-[9px] shadow-md">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                </template>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>


                    <!-- ============================================== -->
                    <!-- 3. TITLE & NOTICE CARD (Optional)              -->
                    <!-- ============================================== -->
                    <div class="bg-white border-2 border-slate-200 rounded-3xl p-6 shadow-md">
                        <div class="flex items-center gap-2 pb-3 mb-4 border-b border-slate-100">
                            <span class="w-8 h-8 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-sm font-black">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </span>
                            <div>
                                <h2 class="text-sm font-black text-slate-900">
                                    {{ $isGu ? '૩. શીર્ષક અને દૈનિક નોટિસ (વૈકલ્પિક)' : '3. Title & Daily Announcement (Optional)' }}
                                </h2>
                                <p class="text-[11px] text-slate-500 font-medium">
                                    {{ $isGu ? 'દર્શન પેજ પર દેખાતું શીર્ષક અને વિશેષ સૂચના' : 'Live page headline and announcement' }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-3 text-xs">
                            @if($isGu)
                                <div>
                                    <label class="block font-bold text-slate-800 mb-1">લાઈવ દર્શન શીર્ષક</label>
                                    <input type="text" name="title_gu" value="{{ old('title_gu', $live ? ($live->title_gu ?: $live->title_en) : 'શ્રી ગાત્રાળ માં અખંડ લાઈવ આરતી & દર્શન') }}"
                                           class="w-full bg-white border border-slate-300 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-800 mb-1">દૈનિક નોટિસ / વિશેષ સૂચના</label>
                                    <textarea name="notice_gu" rows="2" placeholder="આજની વિશેષ આરતી કે શૃંગારની માહિતી..."
                                              class="w-full bg-white border border-slate-300 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm">{{ old('notice_gu', $live ? ($live->notice_gu ?: $live->notice_en) : '') }}</textarea>
                                </div>
                            @else
                                <div>
                                    <label class="block font-bold text-slate-800 mb-1">Live Darshan Title</label>
                                    <input type="text" name="title_en" value="{{ old('title_en', $live ? ($live->title_en ?: $live->title_gu) : 'Shree Gatrad Maa Live Aarti & Darshan') }}"
                                           class="w-full bg-white border border-slate-300 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 font-semibold shadow-sm">
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-800 mb-1">Daily Notice / Announcement</label>
                                    <textarea name="notice_en" rows="2" placeholder="Today's special timings or festive notices..."
                                              class="w-full bg-white border border-slate-300 rounded-xl px-3.5 py-2.5 focus:border-orange-500 focus:outline-none text-slate-900 shadow-sm">{{ old('notice_en', $live ? ($live->notice_en ?: $live->notice_gu) : '') }}</textarea>
                                </div>
                            @endif
                        </div>
                    </div>


                    <!-- ============================================== -->
                    <!-- SUBMIT BUTTON                                  -->
                    <!-- ============================================== -->
                    <button type="submit" 
                            class="w-full py-4 rounded-2xl bg-gradient-to-r from-amber-500 via-orange-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white font-black text-sm shadow-xl shadow-orange-500/30 transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2.5 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-yellow-200 text-base"></i>
                        <span>{{ $isGu ? 'બધા ફેરફારો સેવ કરો (Save All Changes)' : 'Save All Changes' }}</span>
                    </button>
                </form>

            </div>

            <!-- Right Preview Column (Col 5) -->
            <div class="lg:col-span-5 bg-white border-2 border-orange-200 rounded-3xl p-6 shadow-xl space-y-6 sticky top-6">
                <div>
                    <h2 class="text-sm font-black text-slate-900 pb-2 border-b border-orange-100 flex items-center gap-2">
                        <i class="fa-solid fa-eye text-orange-600"></i>
                        <span>{{ $isGu ? 'લાઈવ પૂર્વાવલોકન (વેબસાઇટ પર કેવું દેખાશે)' : 'Live Preview (Website View)' }}</span>
                    </h2>
                    <p class="text-[11px] text-slate-500 mt-1 font-medium">
                        {{ $isGu ? 'તમે પસંદ કરેલ વિડીયો અને ફોટો અહીં તાત્કાલિક દેખાશે.' : 'Instant preview of selected video URL and shringar photo.' }}
                    </p>
                </div>

                <!-- 1. Video Player Live Preview -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-black text-red-700 flex items-center gap-1.5">
                            <i class="fa-brands fa-youtube text-red-600"></i>
                            <span>{{ $isGu ? 'વિડીયો પ્લેયર પ્રિવ્યૂ:' : 'Video Player Preview:' }}</span>
                        </span>
                        <template x-if="extractId(videoUrl)">
                            <span class="text-[10px] font-black text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-full border border-emerald-300 flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 animate-pulse"></span>
                                <span>{{ $isGu ? 'લાઈવ' : 'Live' }}</span>
                            </span>
                        </template>
                    </div>

                    <div class="aspect-video bg-black rounded-2xl overflow-hidden border-2 border-red-200 shadow-md flex items-center justify-center relative">
                        <template x-if="extractId(videoUrl)">
                            <iframe class="w-full h-full" 
                                    :src="'https://www.youtube-nocookie.com/embed/' + extractId(videoUrl) + '?rel=0'" 
                                    frameborder="0" 
                                    allowfullscreen>
                            </iframe>
                        </template>
                        <template x-if="!extractId(videoUrl)">
                            <div class="text-center p-4">
                                <i class="fa-solid fa-video-slash text-2xl text-slate-500 mb-2 block"></i>
                                <span class="text-xs text-slate-400 font-bold">
                                    {{ $isGu ? 'YouTube URL દાખલ કરો' : 'Enter YouTube URL' }}
                                </span>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- 2. Daily Shringar Photo Preview -->
                <div class="pt-4 border-t border-slate-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-black text-amber-800 flex items-center gap-1.5">
                            <i class="fa-solid fa-camera text-amber-600"></i>
                            <span>{{ $isGu ? 'આજનો શૃંગાર ફોટો પ્રિવ્યૂ:' : "Today's Shringar Preview:" }}</span>
                        </span>
                        <template x-if="hasNewFile">
                            <span class="text-[10px] font-black text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-full border border-emerald-300">
                                {{ $isGu ? 'નવી ફાઈલ પસંદ થઈ' : 'New File' }}
                            </span>
                        </template>
                    </div>

                    <div class="min-h-[280px] max-h-[420px] bg-gradient-to-b from-slate-950 via-slate-900 to-amber-950 rounded-2xl overflow-hidden border-2 border-amber-300 shadow-lg p-2.5 flex items-center justify-center relative">
                        <img :src="previewUrl" 
                             alt="Today's Shringar" 
                             class="max-h-[390px] w-auto max-w-full rounded-xl object-contain shadow-2xl transition duration-300"
                             onerror="this.onerror=null; this.src='/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg';">

                        <div class="absolute bottom-3 right-3 bg-black/75 backdrop-blur-sm text-yellow-300 text-[10px] font-bold px-2.5 py-1 rounded-xl border border-yellow-500/40 pointer-events-none">
                            <i class="fa-solid fa-sparkles mr-1 text-yellow-400"></i>
                            <span>{{ $isGu ? 'શૃંગાર દર્શન' : 'Shringar Darshan' }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection
