<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
	 protected $table = 'product_photos';
    protected $fillable = ['product_id', 'filename'];

    public function product()
    {
        return $this->belongsToMany('App\Product')->withTimestamps();
    }
}
