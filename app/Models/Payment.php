<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable =[
        'amount',
        'taxes',
        'customer_id',
        'movie_id',
        'status',
    ];
    CONST STATUS =[
        1=>'success',
        0=>'faild',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function movies()
    {
        return $this->belongsTo(Movie::class,'movie_id');
    }
}
