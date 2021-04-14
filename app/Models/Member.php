<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Member extends Model
{
    use HasFactory;

    public function memberReservoirs()
    {
        // return $this->hasMany('App\Models\Reservoir', 'reservoir_id', 'id');
        return $this->belongsTo('App\Models\Reservoir', 'reservoir_id', 'id');
    }
}
