<?php

namespace App\Repository\Customer\CustomerProfile;

use App\Models\Movie;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\HistoryRecource;
use Illuminate\Support\Facades\Storage;



class ProfileService implements IProfileInterface,IUpdateImageProfileInterface,
IShowAllHistoeyInterface ,IClearAllHistoryInterface,IClearSingleHistoryInterface,ICanShowMovieInterface{


    public function updateProfile($id, $request){

        $customer = Customer::find($id);
        if($customer){
            $customer->update([
                'join_year'=>$request->join_year,
            ]);
            $customer->users->update([
                'name'=>$request->name ,
                'email'=>$request->email ,
                'password'=>Hash::make($request->password) ,
                'age'=>$request->age ,
            ]);
            return true;

        }else{
            return false;
        }
    }

    public function updateProfileImage($id,$request){
        $customer = Customer::find($id);
        if ($customer) {
            $oldImage = $customer->image;
            if ($oldImage) {

                Storage::delete('customers/images', $oldImage);
            }

            $file = $request->image;

            $newImage = Storage::putFile('customers/images', $file);
            $customer->update([
                'image' => $newImage
            ]);
            return true;

        } else {
            return false;

        }
    }
    public function showHistory($id){
        $customer = Customer::find($id);

        $history =  $customer->movies;

       $data =  HistoryRecource::collection($history);
        return $data;
    }

    public function clearAllHistory($id){
        $customer = Customer::find($id);
        if ($customer) {

            $customer->movies()->detach();

            return true;

        } else {
            return false;

        }
    }




    public function clearSingleHistory($request){

        $movieRemove = Movie::find($request->movie_id);
        $customer = Customer::find($request->customer_id);

        if ($customer && $movieRemove) {

            $customer->movies()->detach($movieRemove);

            return true;
        } else {
            return false;
        }
    }

    public function CanShowMovies($request){
        $movie = Movie::find($request->movie_id);
        // $category = Category::find($request->category_id);

        $reviews =  $movie->reviews()->where('movie_id', $request->movie_id)->get();
        // dd($movie->categories);
        foreach($movie->categories as $ca){
            $cate = $ca->name;

        }
        $category = Category::where('name',$cate)->first();
        // dd($category);

        $movies = $category->movies;

        // dd($movies);


        // $movies = Movie::whereHas("categories", function (Builder $query) use($categories)  {
        //     $query->whereIn('category_id', $categories);
        // })->get();

        // $user = auth('api')->user();
        // $customer = Customer::where('user_id', $user->id)->get();
        // if($customer){

        //     $category = Category::find($request->category_id);
        // }

        // foreach ( $movies  as $movie_category){
        //   $moviess = $movie_category->title;

        // }

        $data['movie'] = $movie;
        $data['reviews'] =  $reviews;
        $data['movies'] =   $movies;

        return $data;
    }
}