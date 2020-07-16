<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    protected $fillable = ['name','image'];

    public function song(){
    	return $this->belongsToMany(song::class, 'song_subcategory')->withTimestamps();
    }
}
