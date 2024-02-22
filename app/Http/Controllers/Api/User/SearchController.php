<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Customer\Search\ISearchByCategoryInterface;
use App\Repository\Customer\Search\ISearchByPaidOrFreeInterface;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{

    public $searchByCategory;
    public $searchPaidOrFree;

    public function __construct(
        ISearchByCategoryInterface $searchByCategoryInterface,
        ISearchByPaidOrFreeInterface $searchPaidOrFreeInterface
    ) {
        $this->searchByCategory = $searchByCategoryInterface;
        $this->searchPaidOrFree = $searchPaidOrFreeInterface;
    }
    public function searchByCategory(Request $request)
    {
        $movies = $this->searchByCategory->searchByCategory($request);
        return $movies;
    }

    public function searchMoviePaidOrFree(Request $request)
    {

        $movies = $this->searchPaidOrFree->searchMoviePaidOrFree($request);


        return $movies;
    }
}
