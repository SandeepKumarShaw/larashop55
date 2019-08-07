<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['cat_name'];
    public function products(){
    	return $this->belongsToMany('App\Product')->withTimestamps();
    }
    public function childs(){
      return $this->hasMany('App\Category','parent_id');
    }
    
}
