<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'excerpt', 'body', 'byline', 'image', 'video', 'published_at', 'slug'];

    protected $appends = ['path'];

    protected $dates = ['published_at'];

    protected $casts = [
        'published_at' => 'datetime:l, F jS, Y'
    ];


    public function editPath()
    {
        return '/admin/posts/' . $this->slug . '/edit';
    }

    public function getPathAttribute()
    {
        return '/blog/' . $this->slug;
    }

    public function scopePublished()
    {
        return Post::where('published_at', '!=', null)->where('published_at', '<=', Carbon::now())->latest()->get();
    }
}
