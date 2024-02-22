<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title',
        'summery',
        'video',
        'image',
        'duration',
        'lanchYear',
        'isFree',
    ];

    const TYPE = [
        0 => 'free',
        1 => 'paid',
    ];
    protected $hidden  =['pivot','created_at','deleted_at','updated_at'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'category_movies');
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'movie_users');
    }

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class,'movie_customers');
    }


    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function interactions(): HasMany
    {
        return $this->hasMany(Interaction::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class,'movie_id','id');
    }
}
