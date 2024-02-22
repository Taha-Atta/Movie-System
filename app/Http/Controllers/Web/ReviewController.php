<?php

namespace App\Http\Controllers\Web;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:super-admin');
        $this->middleware('permission:edit review', ['only' => ['update', 'edit',]]);
        $this->middleware('permission:delete any review', ['only' => ['destroy']]);
        $this->middleware('permission:create new review', ['only' => ['createe', 'storee']]);
        $this->middleware('permission:show all reviews', ['only' => ['index']]);
        $this->middleware('permission:hide review', ['only' => ['hideReview']]);
        $this->middleware('permission:unhide review', ['only' => ['unhideReview']]);
    }
    public function index()
    {
        $reviews = Review::all();

        return view('Admin.Template.Review.index',compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createe( $id)
    {

        $movie= Movie::findOrFail($id);
        // dd($movie);

            return view('Admin.Template.Review.create',compact('movie'));
    }
    public function create(Movie $movie)
    {

        dd($movie);
            // $movie= Movie::findOrFail($id);

            return view('Admin.Template.Review.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(){

    }
    public function storee(Request $request,$id)
    {

        $request->validate([
            'stars'=>"required|numeric",
            'comment'=>"required|string|max:255",
        ]);

        $user_id= auth()->user()->id;

        $movie= Movie::findOrFail($id);
        $movie_id=$movie->id;

        Review::create([
            'stars'=>$request->stars,
            'comment'=>$request->comment,
            'user_id'=> $user_id,
            'movie_id'=> $movie_id,
        ]);

        return to_route('movi.show', $movie->id)->with('success','Review created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::findOrFail($id);
        $reviews =$movie->reviews;
        return view('Admin.Template.Review.show',compact('movie','reviews'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::findOrFail($id);
        return view('Admin.Template.Review.edit',compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'stars'=>"required|numeric",
            'comment'=>"required|string|max:255",
        ]);
        $review = Review::findOrFail($id);

        $review->update([
            'stars'=>$request->stars,
            'comment'=>$request->comment,
        ]);

        return to_route('review.index')->with('success','Review updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return to_route('review.index')->with('success','Review deleted successfuly');
    }

    public function hideReview($id){
        $review = Review::findOrFail($id);
        $review->update([
            'visibilaty'=>false
        ]);

        return to_route('review.index')->with('success','Review hide successfuly');
    }
    public function unhideReview($id){
        $review = Review::findOrFail($id);
        $review->update([
            'visibilaty'=>true
        ]);

        return redirect()->back()->with('success','Review unhide successfuly');
    }
}
