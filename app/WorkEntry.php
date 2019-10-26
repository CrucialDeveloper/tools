<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class WorkEntry extends Model
{
    protected $dates = ['start_date', 'end_date'];
    protected $fillable = ['user_id', 'start_date', 'end_date', 'description', 'billable', 'url_id'];

    public function getRouteKeyName()
    {
        return 'url_id';
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($entry) {
            $entry->update([
                'url_id' => Hashids::connection('project')->encode($entry->id)
            ]);
        });
    }
}
