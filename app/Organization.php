<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function users(){
    	return $this->hasmany(User::class);
    }

    public function departments(){
    	return $this->hasmany(Department::class);
    }
}
