<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    public function statuses()
    {
        return $this->hasOne(Status::class, 'status_id', 'event');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function changes()
    {
        return $this->hasOne(Change::class, 'edit_id', 'edit_id');
    }
}
