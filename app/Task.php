<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id', 'client_id', 'project_id', 'title', 'description', 'status', 'url_id'];

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
}
