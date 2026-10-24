@extends('frontend.layouts.master')

@section('title', __('messages.nav_blog') . ' | ' . __('messages.site_title'))

@section('content')

    <!-- Banner Header (Yellow, White, Orange) -->
    <div class="py-14 bg-gradient-to-b from-orange-50 via-amber-50 to-white border-b-2 border-orange-100 text-center">
        <div class="max-w-4xl mx-auto px-4">
            <span class="text-xs font-black text-orange-700 uppercase tracking-widest bg-yellow-200 px-4 py-1.5 rounded-full border border-yellow-400 shadow-sm">
                {{ __('messages.blog_badge') }}
            </span>
            <h1 class="text-3xl sm:text-5xl font-black text-slate-900 heading-divine mt-4">
                {{ __('messages.nav_blog') }}
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-3 max-w-2xl mx-auto font-medium">
                {{ __('messages.blog_subheading') }}
            </p>
        </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <article class="bg-white border-2 border-orange-200 hover:border-orange-500 rounded-3xl overflow-hidden shadow-md hover:shadow-2xl flex flex-col justify-between transition duration-300 group hover:-translate-y-1">
                    
                    <div>
                        <!-- Cover Image -->
                        <a href="{{ route('blog.show', $post->slug) }}" class="block aspect-video overflow-hidden bg-slate-100 relative">
                            @if($post->image_url)
                                <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @endif
                            <span class="absolute bottom-3 left-3 bg-white/95 text-orange-700 border border-orange-200 text-[10px] font-black px-2.5 py-1 rounded-lg shadow-sm">
                                <i class="fa-regular fa-calendar mr-1"></i>
                                {{ $post->published_date ? $post->published_date->format('d M, Y') : '' }}
                            </span>
                        </a>

                        <!-- Body -->
                        <div class="p-6">
                            <h2 class="text-lg font-bold text-slate-900 group-hover:text-orange-600 transition leading-snug">
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <p class="text-slate-600 text-xs mt-3 leading-relaxed line-clamp-3 font-normal">
                                {{ $post->excerpt }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer Link -->
                    <div class="px-6 pb-6 pt-2">
                        <a href="{{ route('blog.show', $post->slug) }}" class="text-xs font-bold text-orange-600 hover:text-orange-700 flex items-center gap-1 group-hover:gap-2 transition-all">
                            <span>{{ __('messages.btn_read_more') }}</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>

                </article>
            @empty
                <div class="col-span-full bg-white border-2 border-dashed border-orange-200 rounded-3xl p-12 text-center text-slate-500 text-sm font-semibold">
                    <i class="fa-solid fa-newspaper text-4xl text-orange-400 mb-3 block"></i>
                    {{ app()->getLocale() == 'gu' ? 'હાલમાં કોઈ સમાચાર કે લેખ પ્રસિદ્ધ થયેલ નથી. એડમિન પેનલમાંથી ઉમેરી શકો છો.' : 'No blog posts or news published yet. Add posts from admin panel.' }}
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>

    </div>

@endsection
