<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

    public function tracks()
    {
        return $this->hasOne(BusinessTrack::class);
    }
}
