<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCaseDetail extends Model
{
    public function tracks(){
        return $this->belongsTo(BusinessTrack::class);
    }
}
