<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['category'])
            ->withCount('gifts')
            ->when($request->q, fn ($q, $term) =>
                $q->where('title', 'like', "%{$term}%")
            )
            ->when($request->status, fn ($q, $status) =>
                $q->where('status', $status)
            )
            ->when($request->category, fn ($q, $id) =>
                $q->where('category_id', $id)
            )
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.posts.index', [
            'posts' => $posts,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.posts.form', [
            'post' => new Post([
                'status' => 'draft',
                'read_minutes' => 5,
            ]),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        $data['user_id'] = $request->user()->id;
        $data['cover_image'] = $this->cover($request, null);

        $post = Post::create($data);

        return redirect()
            ->route('admin.posts.gifts.index', $post)
            ->with('status', 'Post created. Now add the gift cards.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', [
            'post' => $post,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $data = $this->validated($request, $post);

        $data['cover_image'] = $this->cover($request, $post);

        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('status', 'Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('status', 'Post deleted.');
    }

    private function validated(Request $request, ?Post $post = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($post?->id),
            ],

            'category_id' => ['nullable', 'exists:categories,id'],
            'eyebrow' => ['nullable', 'string', 'max:60'],
            'subtitle' => ['nullable', 'string', 'max:160'],
            'excerpt' => ['nullable', 'string', 'max:600'],
            'body' => ['nullable', 'string'],
            'pull_quote' => ['nullable', 'string', 'max:255'],
            'read_minutes' => ['required', 'integer', 'min:1', 'max:120'],

            'status' => [
                'required',
                Rule::in(['draft', 'published']),
            ],

            'published_at' => ['nullable', 'date'],
            'is_featured' => ['nullable', 'boolean'],
            'is_popular' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],

        ]) + [
            'is_featured' => $request->boolean('is_featured'),
            'is_popular' => $request->boolean('is_popular'),
        ];
    }

    private function cover(Request $request, ?Post $post): ?string
    {
        $request->validate([
            'cover_file' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'cover_url' => [
                'nullable',
                'url',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload file directly to Cloudinary REST API
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_file')) {

            $cloudName = env('CLOUDINARY_CLOUD_NAME');
            $apiKey = env('CLOUDINARY_API_KEY');
            $apiSecret = env('CLOUDINARY_API_SECRET');

            if (!$cloudName || !$apiKey || !$apiSecret) {
                throw new \RuntimeException(
                    'Cloudinary environment variables are missing.'
                );
            }

            $timestamp = time();

            $folder = 'gifttrandly/covers';

            /*
             * Cloudinary signature:
             * parameters sorted alphabetically + API secret
             */
            $signatureString =
                'folder=' . $folder .
                '&timestamp=' . $timestamp .
                $apiSecret;

            $signature = sha1($signatureString);

            $file = $request->file('cover_file');

            $response = Http::timeout(60)
                ->attach(
                    'file',
                    file_get_contents($file->getRealPath()),
                    $file->getClientOriginalName()
                )
                ->post(
                    "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload",
                    [
                        'api_key' => $apiKey,
                        'timestamp' => $timestamp,
                        'signature' => $signature,
                        'folder' => $folder,
                    ]
                );

            $response->throw();

            return $response->json('secure_url');
        }

        /*
        |--------------------------------------------------------------------------
        | External image URL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('cover_url')) {
            return $request->input('cover_url');
        }

        /*
        |--------------------------------------------------------------------------
        | Keep existing image
        |--------------------------------------------------------------------------
        */

        return $post?->cover_image;
    }
}