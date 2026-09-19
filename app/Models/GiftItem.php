<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GiftItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id', 'title', 'description', 'image', 'tags',
        'affiliate_url', 'button_label', 'price', 'position',
    ];

    protected $casts = [
        'tags'  => 'array',
        'price' => 'decimal:2',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (! $this->image) {
            return asset('images/placeholder.svg');
        }

        return Str::startsWith($this->image, ['http://', 'https://'])
            ? $this->image
            : asset('storage/' . $this->image);
    }
}
