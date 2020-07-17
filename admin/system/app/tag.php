<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $fillable = ['name'];

    public function songs(){
    	return $this->belongsToMany(song::class)->withTimestamps();
    }
}
