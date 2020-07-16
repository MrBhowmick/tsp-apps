<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class maincategory extends Model
{
    protected $fillable = ['name','image'];

    public function song(){
    	return $this->hasMany(song::class);
    }
}
