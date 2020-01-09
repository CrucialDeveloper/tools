<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WorkEntry extends Model

{
    protected $fillable = ['user_id', 'client_id', 'project_id', 'start_time', 'end_time', 'work_type', 'description', 'duration', 'billable', 'client_url_id', 'project_url_id'];
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

    public function getDurationAttribute($value)
    {
        return  Carbon::createFromTimestampMs($value)->format('H:i:s');
    }
}
