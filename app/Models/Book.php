<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title','slug','description','author','publisher','cover','price','view','stock','status','created_by','updated_by'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function order()
    {
        return $this->belongsToMany('App\Models\Order');
    }
    
}
