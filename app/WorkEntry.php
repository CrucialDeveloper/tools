<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WorkEntry extends Model

{
    protected $fillable = ['user_id', 'client_id', 'project_id', 'start_time', 'end_time', 'work_type', 'description', 'work_time', 'billable', 'client_url_id', 'project_url_id'];
    protected $dates = ['start_time', 'end_time'];
    protected $appends = ['path'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getPathAttribute()
    {
        return "/clients/{$this->client_url_id}/projects/{$this->project_url_id}/timekeep/{$this->id}";
    }

    // public function getStartTimeAttribute($value)
    // {
    //     return Carbon::parse($value)->setTimezone('US/Central')->format('Y-m-d g:i A');
    // }

    // public function getEndTimeAttribute($value)
    // {
    //     return Carbon::parse($value)->setTimezone('US/Central')->format('Y-m-d g:i A');
    // }

    // public function getWorkTimeAttribute($value)
    // {
    //     return Carbon::createFromTimestampMs($value)->format('H:i:s');
    // }
}
