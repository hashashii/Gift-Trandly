<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'user_id', 'title', 'slug', 'eyebrow', 'subtitle',
        'excerpt', 'body', 'cover_image', 'pull_quote', 'read_minutes',
        'is_featured', 'is_popular', 'status', 'published_at',
        'meta_title', 'meta_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured'  => 'boolean',
        'is_popular'   => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Post $post) {
            $post->slug = $post->slug ?: Str::slug($post->title);

            if ($post->status === 'published' && ! $post->published_at) {
                $post->published_at = now();
            }
        });
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
                     ->where('published_at', '<=', now());
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function gifts()
    {
        return $this->hasMany(GiftItem::class)->orderBy('position');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getCoverUrlAttribute(): string
    {
        if (! $this->cover_image) {
            return asset('images/placeholder.svg');
        }

        return Str::startsWith($this->cover_image, ['http://', 'https://'])
            ? $this->cover_image
            : asset('storage/' . $this->cover_image);
    }
}
