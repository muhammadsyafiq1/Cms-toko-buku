<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'image','created_by','name','title'
    ];

    public function getPhotoAttribute($value)
    {
        return url('storage/'.$value);
    }

    public function book()
    {
        return $this->belongsToMany('App\Models\Book');
    }
}
