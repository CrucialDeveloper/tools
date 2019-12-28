<?php

namespace App;

use App\User;
use App\Project;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'company_name', 'address', 'city', 'state', 'zip', 'country', 'phone_number', 'website', 'url_id'];
    protected $appends = ['path'];

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

    public function getPathAttribute()
    {
        return "/clients/$this->url_id";
    }
}
