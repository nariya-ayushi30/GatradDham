<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogManagerController extends Controller
{
    /**
     * List all blog posts
     */
    public function index()
    {
        $posts = BlogPost::orderBy('published_date', 'desc')->paginate(10);

        return view('admin.blogs.index', compact('posts'));
    }

    /**
     * Store new blog post (English First with File Upload)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:200',
            'title_gu' => 'nullable|string|max:200',
            'excerpt_en' => 'nullable|string|max:300',
            'excerpt_gu' => 'nullable|string|max:300',
            'content_en' => 'nullable|string',
            'content_gu' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:500',
            'published_date' => 'required|date',
        ]);

        $titleEn = !empty($validated['title_en']) ? $validated['title_en'] : (!empty($validated['title_gu']) ? $validated['title_gu'] : null);
        $titleGu = !empty($validated['title_gu']) ? $validated['title_gu'] : (!empty($validated['title_en']) ? $validated['title_en'] : null);

        if (empty($titleEn) && empty($titleGu)) {
            $msg = app()->getLocale() == 'gu' ? 'કૃપા કરીને આર્ટિકલનું શીર્ષક દાખલ કરો.' : 'Please enter article title.';
            return back()->withErrors(['title_en' => $msg])->withInput();
        }

        $contentEn = !empty($validated['content_en']) ? $validated['content_en'] : (!empty($validated['content_gu']) ? $validated['content_gu'] : null);
        $contentGu = !empty($validated['content_gu']) ? $validated['content_gu'] : (!empty($validated['content_en']) ? $validated['content_en'] : null);

        if (empty($contentEn) && empty($contentGu)) {
            $msg = app()->getLocale() == 'gu' ? 'કૃપા કરીને સમાચારનું લખાણ દાખલ કરો.' : 'Please enter article content.';
            return back()->withErrors(['content_en' => $msg])->withInput();
        }

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDir = public_path('uploads/blogs');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $imageUrl = '/uploads/blogs/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $imageUrl = $validated['image_url'];
        }

        $slugBase = $titleEn ?: $titleGu;
        $slug = Str::slug($slugBase) ?: 'post-' . uniqid();
        if (BlogPost::where('slug', $slug)->exists()) {
            $slug .= '-' . rand(100, 999);
        }

        $excerptEn = !empty($validated['excerpt_en']) ? $validated['excerpt_en'] : (!empty($validated['excerpt_gu']) ? $validated['excerpt_gu'] : Str::limit(strip_tags((string)$contentEn), 120));
        $excerptGu = !empty($validated['excerpt_gu']) ? $validated['excerpt_gu'] : (!empty($validated['excerpt_en']) ? $validated['excerpt_en'] : Str::limit(strip_tags((string)$contentGu), 120));

        BlogPost::create([
            'title_en' => $titleEn,
            'title_gu' => $titleGu,
            'slug' => $slug,
            'excerpt_en' => $excerptEn,
            'excerpt_gu' => $excerptGu,
            'content_en' => $contentEn,
            'content_gu' => $contentGu,
            'image_url' => $imageUrl,
            'published_date' => $validated['published_date'],
        ]);

        $successMsg = app()->getLocale() == 'gu' ? 'સમાચાર લેખ સફળતાપૂર્વક પ્રકાશિત થયો.' : 'Blog article published successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Update existing blog post
     */
    public function update(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        $validated = $request->validate([
            'title_en' => 'nullable|string|max:200',
            'title_gu' => 'nullable|string|max:200',
            'excerpt_en' => 'nullable|string|max:300',
            'excerpt_gu' => 'nullable|string|max:300',
            'content_en' => 'nullable|string',
            'content_gu' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:500',
            'published_date' => 'required|date',
        ]);

        if ($request->has('title_gu') || $request->has('title_en')) {
            $post->title_gu = $request->title_gu ?: ($request->title_en ?: $post->title_gu);
            $post->title_en = $request->title_en ?: ($request->title_gu ?: $post->title_en);
        }
        if ($request->has('excerpt_gu') || $request->has('excerpt_en')) {
            $post->excerpt_gu = $request->excerpt_gu ?: ($request->excerpt_en ?: $post->excerpt_gu);
            $post->excerpt_en = $request->excerpt_en ?: ($request->excerpt_gu ?: $post->excerpt_en);
        }
        if ($request->has('content_gu') || $request->has('content_en')) {
            $post->content_gu = $request->content_gu ?: ($request->content_en ?: $post->content_gu);
            $post->content_en = $request->content_en ?: ($request->content_gu ?: $post->content_en);
        }

        $post->published_date = $validated['published_date'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDir = public_path('uploads/blogs');
            if (!File::isDirectory($uploadDir)) {
                File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($uploadDir, $filename);
            $post->image_url = '/uploads/blogs/' . $filename;
        } elseif (!empty($validated['image_url'])) {
            $post->image_url = $validated['image_url'];
        }

        $post->save();

        $successMsg = app()->getLocale() == 'gu' ? 'સમાચાર લેખ સફળતાપૂર્વક અપડેટ થયો.' : 'Blog article updated successfully.';
        return back()->with('success', $successMsg);
    }

    /**
     * Delete blog post
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        if ($post->image_url && str_starts_with($post->image_url, '/uploads/blogs/')) {
            $localPath = public_path($post->image_url);
            if (File::exists($localPath)) {
                File::delete($localPath);
            }
        }

        $post->delete();

        $successMsg = app()->getLocale() == 'gu' ? 'સમાચાર લેખ સફળતાપૂર્વક ડિલીટ કર્યો.' : 'Blog article deleted successfully.';
        return back()->with('success', $successMsg);
    }
}
