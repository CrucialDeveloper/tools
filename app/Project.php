<?php

namespace App;

use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'status', 'start_date', 'due_date', 'priority', 'available_status', 'url_id'];

    protected $appends = ['past_due'];

    public function getRouteKeyName()
    {
        return 'url_id';
    }

    protected $casts = [
        'available_status' => 'json',
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function ($project) {
            $project->update([
                'url_id' => Hashids::connection('project')->encode($project->id)
            ]);
        });
    }

    public function getPastDueAttribute()
    {
        return $this->due_date < Carbon::now() && $this->status != "Completed";
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function files()
    {
        return $this->morphMany('App\File', 'fileable');
    }
}
