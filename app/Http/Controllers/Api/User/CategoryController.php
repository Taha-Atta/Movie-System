<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repository\Customer\Category\IShowAllCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $showAllCaregories;

    public function __construct(IShowAllCategory $showCategoriesinterface)
    {
        $this->showAllCaregories =  $showCategoriesinterface;
    }
    /**
     * @OA\Get(
     *     path="/api/customer/AllCategory",
     *     summary="Get All Category",
     *     @OA\Response(response="200", description="Success"),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function AllCategory(){

        $data =   $this->showAllCaregories->AllCategory();

      return $data;
    }
}
