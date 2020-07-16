<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class song extends Model
{
    protected $fillable = ['name','image','maincategory_id'];

    public function maincategory(){
    	return $this->belongsTo(maincategory::class);
    }
    public function tags(){
    	return $this->belongsToMany(tag::class)->withTimestamps();
    }
    public function subcategory(){
    	return $this->belongsToMany(subcategory::class, 'song_subcategory')->withTimestamps();
    }
}
