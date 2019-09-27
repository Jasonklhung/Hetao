<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timeset extends Model
{
    protected $fillable = [
        'organization_id', 'name', 'days', 'time', 'status'
    ];
}
