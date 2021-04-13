<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Member;

class Reservoir extends Model
{
    use HasFactory;

    public function reservoirMember()   //--> funkcijos vardas bookAuthornieko nereiskia, pasirenkam i koki sugalvojam
    {
        return $this->belongsTo(Member::class, 'reservoir_id', 'id');
        //si knyga -> pagal autoriaus id priklauso autoriui, kurio id yra toks.
        
    }
}
