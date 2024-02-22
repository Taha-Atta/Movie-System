<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =['image','join_year','user_id'];


    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class,'movie_customers');
    }
    public function users(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function payments(){
        return $this->hasOne(Payment::class,'customer_id','id');
    }
}
