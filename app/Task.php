<?php

namespace App;

use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'client_id', 'project_id', 'client_url_id', 'project_url_id', 'title', 'description', 'status', 'start_date', 'due_date', 'priority', 'url_id'];
    protected $appends = ['path', 'past_due'];


    public function getRouteKeyName()
    {
        return 'url_id';
    }


    public static function boot()
    {
        parent::boot();
        static::created(function ($task) {
            $task->update([
                'url_id' => Hashids::connection('task')->encode($task->id)
            ]);
        });
    }
    public function getPathAttribute()
    {
        return "/clients/" . $this->client_url_id . "/projects/" . $this->project_url_id . '/tasks/' . $this->url_id;
    }

    public function getPastDueAttribute()
    {
        return $this->due_date < Carbon::now() && $this->status != "Completed";
    }
}
