<?php

namespace App;

use App\User;
use App\Contact;
use App\Project;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'company_name', 'address', 'city', 'state', 'zip', 'country', 'phone_number', 'website', 'project_status_options', 'work_type', 'url_id'];
    protected $appends = ['path'];
    protected $casts = ['project_status_options' => 'json', 'work_type' => 'json'];

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

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function getPathAttribute()
    {
        return "/clients/$this->url_id";
    }
}
