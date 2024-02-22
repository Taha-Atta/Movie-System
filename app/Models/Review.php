<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable =['stars','comment','user_id','movie_id','visibilaty'];

     protected $hidden  =['movie_id','created_at','deleted_at','updated_at','user_id'];

    public function movies(): BelongsTo
    {
        return $this->belongsTo(Movie::class,'movie_id');
    }
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
