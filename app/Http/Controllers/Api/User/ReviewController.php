<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\ReviewUpdateRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Repository\Customer\Review\ICreateReviewInterface;
use App\Repository\Customer\Review\IDeleteReviewInterface;
use App\Repository\Customer\Review\IEditReviewInterface;
use Illuminate\Http\Request;


class ReviewController extends Controller
{
    public $CreateService;
    public $EditService;
    public $DeleteService;

    public function __construct(
        ICreateReviewInterface $CreateInterface,
        IEditReviewInterface $EditInterface,
        IDeleteReviewInterface $DeleteInterface
    ) {
        $this->CreateService = $CreateInterface;
        $this->EditService = $EditInterface;
        $this->DeleteService = $DeleteInterface;
    }




    /**
     * @OA\Post(
     *     path="/api/customer/CreateReview",
     *     summary="Create Review",
     *     @OA\Parameter(
     *         name="stars",
     *         in="query",
     *         description="review stars",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="comment",
     *         in="query",
     *         description="review comment",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         description="User's id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="movie_id",
     *         in="query",
     *         description="movie id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="201", description="User registered successfully"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
    public function CreateReview(ReviewRequest $request)
    {

        $review =  $this->CreateService->CreateReview($request);
        return response()->json([
            'review' => new ReviewResource($review),
            'status' => 201
        ], 201);
    }

    public function EditReview(ReviewUpdateRequest $request, $id)
    {

        $review = $this->EditService->EditReview($request, $id);
        if ($review) {
            return response()->json([
                'msg' => 'review updated successfully',
                'status' => 201
            ], 201);
        } else {
            return response()->json([
                'msg' => 'review not found',
                'status' => 404
            ], 404);
        }
    }


    public function DeleteReview($id)
    {

        $review = $this->DeleteService->DeleteReview($id);
        if ($review) {
            return response()->json([
                'msg' => 'review deleted successfully',
                'status' => 201
            ], 201);
        } else {
            return response()->json([
                'msg' => 'review not found',
                'status' => 404
            ], 404);
        }
    }
}
