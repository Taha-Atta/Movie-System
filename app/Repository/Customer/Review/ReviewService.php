<?php


namespace App\Repository\Customer\Review;

use App\Models\Review;



class ReviewService implements ICreateReviewInterface,IEditReviewInterface,IDeleteReviewInterface {


    public function CreateReview($request){
        $data = $request->all();

        $review = Review::create($data);

        return $review;
    }

    public function EditReview($request ,$id){


        $review = Review::find($id);

        if($review){
             $review->update([
                'stars'=>$request->stars,
                'comment'=>$request->comment,
                'user_id'=>$request->user_id,
                'movie_id'=>$request->movie_id,
            ]);
            return true;
        }else{
            return false;
        }
    }

    public function DeleteReview($id){

        $review = Review::find($id);
        if($review){
            $review->delete();
            return true;
        }else{
            return false;
        }
    }


}