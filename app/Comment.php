<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'project_id', 'body', 'url_id'];

    public function getRouteKeyName()
    {
        return 'url_id';
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($comment) {
            $comment->update([
                'url_id' => Hashids::connection('comment')->encode($comment->id)
            ]);
        });
    }

    public function commenter()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
