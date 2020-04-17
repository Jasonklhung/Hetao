<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessTrack extends Model
{
    use SoftDeletes;

    public function business(){
        return $this->belongsTo(Business::class);
    }

    public function details(){
    	return $this->hasmany(BusinessCaseDetail::class);
    }
}
