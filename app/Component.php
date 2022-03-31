<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $guarded = [];

    protected $casts = [
        'experience_fragment_path' => 'array',
    ];
}
