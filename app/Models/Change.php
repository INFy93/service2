<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $casts = [
        'old_data' => 'array',
        'changed_data' => 'array'
    ];
}
