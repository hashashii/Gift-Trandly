<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostSection extends Model
{
    protected $fillable = [
        'heading',
        'content',
        'sort_order',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}