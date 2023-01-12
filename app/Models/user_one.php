<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class user_one extends Model
{
    public function carts()
    {
        return $this->hasMany(cart::class, 'user_id', 'id');
    }
}
