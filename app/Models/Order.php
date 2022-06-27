<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->hasOne(Service::class, 'id', 'service');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'manager_id');
    }
}
