<?php

namespace App\Models;

use App\Models\libraries_icon;
use Illuminate\Database\Eloquent\Model;

class libraries extends Model
{
    public function libraries_icons()
    {
        return $this->hasMany(libraries_icon::class,'libraries_id','id');
    }

}
