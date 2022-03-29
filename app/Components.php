<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Components extends Model
{
    protected $guarded = [];

    protected $casts = [
        'experience_fragment_path' => 'array',
    ];
}
