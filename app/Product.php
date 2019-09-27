<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	
   protected $fillable = ['pro_name','pro_code','pro_price','pro_info'];
   
    /*
     *
     * The Products that belong to the Category.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
    //
    public function cats(){
      return $this->belongsTo('App\Category', 'id');
    }
    public function productgalery()
    {
      return $this->belongsToMany('App\ProductPhoto')->withTimestamps();
    }

}
