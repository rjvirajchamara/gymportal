<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    public function item()
    {
        return $this->belongsTo(item::class, 'item_id', 'id');
    }
}
