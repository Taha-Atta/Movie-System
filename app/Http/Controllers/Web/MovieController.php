<?php

namespace App\Http\Controllers\Web;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class MovieController extends Controller
{
    public function __construct()
    {
        // $this->middleware('role:super-admin');
        $this->middleware('permission:create movie', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit movie', ['only' => ['update', 'edit',]]);
        $this->middleware('permission:soft delete movie', ['only' => ['destroy']]);
        $this->middleware('permission:show movie by category id', ['only' => ['index', 'search', 'show']]);
    }

    public function index()
    {

        $movies = Movie::orderBy('title', 'asc')->paginate(3);
        return view('Admin.Template.Movie.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories =   Category::all();
        return view('Admin.Template.Movie.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summery' => "required|string|max:255",
            'duration' => "required|numeric",
            'image' => "nullable|image|mimes:png,jpg",
            'video' => "required|mimes:mp4,mov,avi",
            'lanchYear' => "required|date_format:Y",
            'isFree' => "required|numeric",
            // 'category' => "required|exists:categories,name",
        ]);


        $imageNmae =  Storage::putFile('images', $request->image);


        $videoName =  Storage::putFile('videos', $request->video);

        $movie = Movie::create([
            'title' => $request->title,
            'summery' => $request->summery,
            'duration' => $request->duration,
            'image' => $imageNmae,
            'video' => $videoName,
            'lanchYear' => $request->lanchYear,
            'isFree' => $request->isFree,
        ]);

        $movie->categories()->attach([$request->category]);

        return to_route('movi.index')->with('success', 'movie created successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $movieID)
    {
        $movie =  Movie::findOrFail($movieID);

        return view('Admin.Template.Movie.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($movieID)
    {
        $movie =  Movie::findOrFail($movieID);
        $categories =   Category::all();

        return view('Admin.Template.Movie.edit', compact('movie', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summery' => "required|string|max:255",
            'duration' => "required|numeric",
            'image' => "nullable|image|mimes:png,jpg",
            'video' => "mimes:mp4,mov,avi",
            'lanchYear' => "required|date_format:Y",
            'isFree' => "required|numeric",
        ]);
        $movie =  Movie::findOrFail($id);

        if ($request->has('image')) {
            Storage::delete($movie->image);
            $imageNmae =  Storage::putFile('images', $request->image);
        }
        if ($request->has('video')) {
            Storage::delete($movie->video);
            $videoName =  Storage::putFile('videos', $request->video);
        }
        $movie->update([
            'title' => $request->title,
            'summery' => $request->summery,
            'duration' => $request->duration,
            'lanchYear' => $request->lanchYear,
            'isFree' => $request->isFree,
        ]);
        if (!empty($request->video)) {
            $movie->update([
                'video' => $videoName,

            ]);
        }
        if (!empty($request->image)) {
            $movie->update([
                'image' => $imageNmae,

            ]);
        }
        $movie->categories()->sync([$request->category]);

        return to_route('movi.index')->with('success', 'movie updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $movieID)
    {
        $movie =  Movie::findOrFail($movieID);

        Storage::delete($movie->image);
        Storage::delete($movie->video);
        $movie->categories()->detach();
        $movie->delete();
        return to_route('movi.index')->with('success', 'movie deleted successfuly');
    }

    public function search(Request $request)
    {

        $key = $request->key;

        $movies = Movie::whereHas('categories', function ($q) use ($key) {
            $q->where("name", "like", "%$key%");
        })->paginate(5);

        return view('Admin.Template.Movie.index', compact('movies'));
    }
}
