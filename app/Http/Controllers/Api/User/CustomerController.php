<?php

namespace App\Http\Controllers\Api\User;

use App\Models\Movie;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\MovieResource;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\HistoryRecource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateProfileImageRequest;
use App\Models\Category;
use App\Repository\Customer\CustomerProfile\ICanShowMovieInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Repository\Customer\CustomerProfile\IProfileInterface;
use App\Repository\Customer\CustomerProfile\IShowAllHistoeyInterface;
use App\Repository\Customer\CustomerProfile\IClearAllHistoryInterface;
use App\Repository\Customer\CustomerProfile\IClearSingleHistoryInterface;
use App\Repository\Customer\CustomerProfile\IUpdateImageProfileInterface;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public $updateprofileinfo;
    public $updateImageprofileinfo;
    public $ShowAllHistory;
    public $ClearAllHistory;
    public $ClearSangileHistory;
    public $ICanShowMovie;

    public function __construct(
        IProfileInterface $updateprofileinterface,
        IUpdateImageProfileInterface $updateImageprofileinterface,
        IShowAllHistoeyInterface $showallhistroy,
        IClearAllHistoryInterface $clearallhistory,
        IClearSingleHistoryInterface $clearSainglehistory,
        ICanShowMovieInterface $ICanShowMovieInterface,
    ) {
        $this->updateprofileinfo = $updateprofileinterface;
        $this->updateImageprofileinfo = $updateImageprofileinterface;
        $this->ShowAllHistory = $showallhistroy;
        $this->ClearAllHistory = $clearallhistory;
        $this->ClearSangileHistory = $clearSainglehistory;
        $this->ICanShowMovie = $ICanShowMovieInterface;
    }


    /**
     * @OA\Put(
     *     path="/api/customer/updateProfile/{id}",
     *     summary="Update an existing page",
     *     tags={"profile"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the profile to be updated",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="about",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="website",
     *                     type="string",
     *                     format="url"
     *                 ),
     *                 @OA\Property(
     *                     property="location",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="category_id",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Page updated successfully"),
     *     @OA\Response(response="404", description="Page not found"),
     *     @OA\Response(response="422", description="Validation errors")
     * )
     */
      /**
     * @OA\Post(
     *     path="/api/customer/updateProfile/{id}",
     *     summary="Authenticate user and generate  token",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="User's id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="User's email",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="join_year",
     *         in="query",
     *         description="User's join_year",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="User's name",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="age",
     *         in="query",
     *         description="User's age",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Login successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     */
    public function updateProfile($id, UpdateProfileRequest $request)
    {
        $customer =  $this->updateprofileinfo->updateProfile($id, $request);

        if ($customer) {
            return response()->json([
                'msg' => "update successfuly",
                'status' => 201,
            ], 201);
        } else {
            return response()->json([
                'msg' => "customer not found",
                'status' => 403,
            ], 403);
        }
    }





    public function updateProfileImage($id, UpdateProfileImageRequest $request)
    {
        $customer =   $this->updateImageprofileinfo->updateProfileImage($id, $request);

        if ($customer) {
            return response()->json([
                'msg' => "update  image successfuly",
                'status' => 201,
            ], 201);
        } else {
            return response()->json([
                'msg' => "customer not found",
                'status' => 201,
            ], 201);
        }
    }



    public function showHistory($id)
    {
        $data = $this->ShowAllHistory->showHistory($id);

        return $data;
    }




    public function clearAllHistory($id)
    {
        $customer =  $this->ClearAllHistory->clearAllHistory($id);

        if ($customer) {
            return response()->json([
                'msg' => 'delete all history successfuly',
            ], 201);
        } else {
            return response()->json([
                'msg' => 'customer not found',
            ], 201);
        }
    }





    public function clearSingleHistory(Request $request)
    {

        $data = $this->ClearSangileHistory->clearSingleHistory($request);
        if ($data) {

            return response()->json([
                'msg' => 'delete successfuly',
            ], 201);
        } else {
            return response()->json([
                'msg' => 'customer or movie not found',
            ], 201);
        }
    }


    public function CanShowMovies(Request $request)
    {

        $data = $this->ICanShowMovie->CanShowMovies($request);


        return response()->json([
            'movie' => new MovieResource($data['movie']),
            'review' =>  ReviewResource::collection($data['reviews']),
            'movies_recommened' =>  MovieResource::collection($data['movies']),
        ]);
    }
}
