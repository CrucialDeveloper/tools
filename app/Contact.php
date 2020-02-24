<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'client_id',
        'first_name',
        'last_name',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'phone_number'
    ];
}
