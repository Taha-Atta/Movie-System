<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interaction extends Model
{
    use HasFactory;


    protected $fillable =['isLike','status','user_id','movie_id'];

    public function movies(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
