<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory ,SoftDeletes;
    protected $fillable = ['name','parent_id'];


    // protected $with="child";

    public function child(){

        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class,'category_movies');
    }
}
