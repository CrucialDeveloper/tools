<?php

namespace App;

use Carbon\Carbon;
use App\WorkEntry;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'parent_url_id', 'title', 'description', 'status', 'start_date', 'due_date', 'priority', 'task_status_options', 'work_type', 'url_id'];
    protected $appends = ['past_due', 'path'];

    public function getRouteKeyName()
    {
        return 'url_id';
    }

    protected $casts = [
        'task_status_options' => 'array',
        'work_type' => 'array',
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

    public function getPathAttribute()
    {
        return "/clients/" . $this->parent_url_id . "/projects/" . $this->url_id;
    }

    public function getPastDueAttribute()
    {
        return $this->due_date < Carbon::now() && $this->status != "Completed";
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function work_entries()
    {
        return $this->hasMany(WorkEntry::class);
    }
}
