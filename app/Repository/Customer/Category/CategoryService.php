<?php

namespace App\Repository\Customer\Category;

use App\Models\Category;
use App\Http\Resources\CategoryResource;



class CategoryService implements IShowAllCategory{

    public function AllCategory(){
        $categories  =   Category::all();

        $data =  CategoryResource::collection($categories);
        
        return $data ;
    }
}