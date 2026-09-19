<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftItem;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GiftItemController extends Controller
{
    public function index(Post $post)
    {
        $post->load('gifts');

        return view('admin.gifts.index', compact('post'));
    }

    public function create(Post $post)
    {
        return view('admin.gifts.form', [
            'post' => $post,
            'gift' => new GiftItem([
                'position' => ($post->gifts()->max('position') ?? 0) + 1,
                'button_label' => 'Check Price',
            ]),
        ]);
    }

    public function store(Request $request, Post $post)
    {
        $data = $this->validated($request);

        $data['image'] = $this->image($request, null);

        $post->gifts()->create($data);

        return redirect()
            ->route('admin.posts.gifts.index', $post)
            ->with('status', 'Gift card added.');
    }

    public function edit(Post $post, GiftItem $gift)
    {
        abort_unless($gift->post_id === $post->id, 404);

        return view('admin.gifts.form', compact('post', 'gift'));
    }

    public function update(Request $request, Post $post, GiftItem $gift)
    {
        abort_unless($gift->post_id === $post->id, 404);

        $data = $this->validated($request);

        $data['image'] = $this->image($request, $gift);

        $gift->update($data);

        return redirect()
            ->route('admin.posts.gifts.index', $post)
            ->with('status', 'Gift card updated.');
    }

    public function destroy(Post $post, GiftItem $gift)
    {
        abort_unless($gift->post_id === $post->id, 404);

        $gift->delete();

        return back()->with('status', 'Gift card deleted.');
    }

    /**
     * Drag-and-drop reorder
     * expects {"order":[3,1,2]}
     */
    public function reorder(Request $request, Post $post)
    {
        $ids = $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer'],
        ])['order'];

        foreach ($ids as $index => $id) {
            GiftItem::where('post_id', $post->id)
                ->whereKey($id)
                ->update([
                    'position' => $index + 1
                ]);
        }

        return response()->json([
            'ok' => true
        ]);
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:600'],
            'tags' => ['nullable', 'string', 'max:255'],
            'affiliate_url' => ['nullable', 'url', 'max:2048'],
            'button_label' => ['required', 'string', 'max:40'],
            'price' => ['nullable', 'numeric', 'min:0'],
            'position' => ['required', 'integer', 'min:0'],
        ]);

        $data['tags'] = collect(
            explode(',', (string) ($data['tags'] ?? ''))
        )
            ->map(fn ($t) => trim($t))
            ->filter()
            ->values()
            ->all();

        return $data;
    }

    private function image(Request $request, ?GiftItem $gift): ?string
    {
        $request->validate([
            'image_file' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096'
            ],

            'image_url' => [
                'nullable',
                'url',
                'max:2048'
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Gift Image to Cloudinary
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image_file')) {

            $cloudName = env('CLOUDINARY_CLOUD_NAME');
            $apiKey = env('CLOUDINARY_API_KEY');
            $apiSecret = env('CLOUDINARY_API_SECRET');

            if (!$cloudName || !$apiKey || !$apiSecret) {
                throw new \RuntimeException(
                    'Cloudinary environment variables are missing.'
                );
            }

            $timestamp = time();

            $folder = 'gifttrandly/gifts';

            // Cloudinary signed upload signature
            $signatureString =
                'folder=' . $folder .
                '&timestamp=' . $timestamp .
                $apiSecret;

            $signature = sha1($signatureString);

            $file = $request->file('image_file');

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
        | Manual Image URL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        /*
        |--------------------------------------------------------------------------
        | Keep current image when editing
        |--------------------------------------------------------------------------
        */

        return $gift?->image;
    }
}