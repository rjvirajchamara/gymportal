<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructionSchedule extends Model
{

    public function libraries()
    {
        return $this->hasOne(libraries::class,'id','libraries_id');
    }

}
