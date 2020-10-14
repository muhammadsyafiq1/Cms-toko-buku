<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id','invoice_number','total_price','status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsToMany('App\Models\Book')->withPivot('quantity');
    }

    public function getTotalQuantity()
    {
        $total_quantity = 0;

        foreach($this->book as $book){
            $total_quantity += $book->pivot->quantity;
        }
        return $total_quantity;
    }
}
