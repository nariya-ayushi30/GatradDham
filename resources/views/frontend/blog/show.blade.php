@extends('frontend.layouts.master')

@section('title', $post->title . ' | ' . __('messages.site_title'))

@section('content')

    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Breadcrumb & Back -->
        <div class="mb-6">
            <a href="{{ route('blog.index') }}" class="text-xs text-orange-600 hover:underline inline-flex items-center gap-1 font-bold">
                <i class="fa-solid fa-arrow-left text-[10px]"></i>
                <span>{{ __('messages.btn_back_to_blog') }}</span>
            </a>
        </div>

        <div class="bg-white border-2 border-orange-200 rounded-3xl p-6 sm:p-10 shadow-xl space-y-6">
            
            <div class="flex items-center gap-3 text-xs text-orange-700">
                <span class="bg-yellow-100 border border-yellow-300 px-3.5 py-1 rounded-full font-bold">
                    <i class="fa-regular fa-calendar mr-1"></i>
                    {{ $post->published_date ? $post->published_date->format('d F Y') : '' }}
                </span>
                <span>•</span>
                <span class="text-slate-500 font-semibold">{{ __('messages.blog_publisher') }}</span>
            </div>

            <h1 class="text-2xl sm:text-4xl font-black text-slate-900 heading-divine leading-snug">
                {{ $post->title }}
            </h1>

            @if($post->image_url)
                <div class="aspect-video w-full rounded-2xl overflow-hidden border-2 border-yellow-400 shadow-md">
                    <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="text-slate-700 text-sm sm:text-base leading-relaxed space-y-4 pt-4 border-t border-slate-100 font-normal">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Share & Contact CTA -->
            <div class="pt-8 border-t border-slate-100 flex flex-wrap justify-between items-center gap-4">
                <div class="text-xs text-slate-600 flex items-center gap-2 font-semibold">
                    <span>{{ __('messages.blog_share') }}</span>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition border border-emerald-300">
                        <i class="fa-brands fa-whatsapp text-sm"></i>
                    </a>
                </div>

                <a href="{{ route('contact') }}" class="btn-theme-gradient font-bold px-5 py-2.5 rounded-xl text-xs">
                    {{ __('messages.btn_contact_office') }}
                </a>
            </div>

        </div>

    </article>

@endsection
