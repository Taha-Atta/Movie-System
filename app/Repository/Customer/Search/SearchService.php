<?php


namespace App\Repository\Customer\Search;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Builder;



class SearchService implements ISearchByCategoryInterface, ISearchByPaidOrFreeInterface
{


    public function searchByCategory($request)
    {
        //    $movie =  Movie::with('categories')->whereHas("category",$key)->get();

        $key = $request->key;
        $movies = Movie::whereHas("categories", function (Builder $query) use ($key) {
            $query->where("name", "like", "%$key%");
        })->get();

        // $category = Category::find($id);
        // $movies =   $category->movies;
        return $movies;
    }

    public function searchMoviePaidOrFree($request){

        $type = $request->type;

     $movies = Movie::where('isFree', $type )->get();

     return $movies;
    }


}
