<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'title',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'phone_number',
        'order'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
