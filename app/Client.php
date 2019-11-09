<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['user_id', 'company_name', 'address', 'city', 'state', 'zip', 'country', 'phone_number', 'url_id'];

    public function getRouteKeyName()
    {
        return 'url_id';
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($client) {
            $client->update([
                'url_id' => Hashids::connection('client')->encode($client->id)
            ]);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
