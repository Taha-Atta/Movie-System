@extends('Admin.Template.base')


@section('content')
    {{-- <div class="container ">
        @include('success')
        @include('errors')


        <h1>{{ $movie->title }}</h1>
        <h4>
            <a href="{{ route('movi.index') }}" class="btn btn-success">Back</a>
        </h4>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card">
                    <video width="320" height="240" controls>
                        <source src="{{ asset("storage/$movie->video") }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <img src="{{ asset("storage/$movie->image") }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h2 class="card">{{ $movie->title }}</h2>
                        <p class="card-text">{{ $movie->summery }}</p>
                        <p class="card-text">{{ $movie->duration }} Hours</p>
                        <p class="card-text">{{ $movie->lanchYear }} LanchYear</p>
                    </div>
                    <a href="{{ route('movi.edit', $movie->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ url('movi/' . $movie->id . '/delete') }}" class="btn btn-danger">Delete</a>
                </div>
            </div>

        </div>
    </div> --}}
    <div class="row mt-3">
        <div class="col-md-10 offset-md-1">
            <div class="list-group">
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>
                            <a href="{{route('movi.index')}}" class="btn btn-primary float-end">back</a>
                            <a href="{{url('review/'.$movie->id.'/createe')}}" class="btn btn-warning float-end">Create Review</a>
                        </h4>
                    </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            <video width="320" height="240" controls>
                                <source src="{{ asset("storage/$movie->video") }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            {{-- <iframe width="240" height="260" src="{{ asset("storage/$movie->video") }}" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" class="border-0" allowfullscreen></iframe> --}}
                        </div>
                        <div class="col-auto">
                            <img class="img-fluid" src="{{ asset("storage/$movie->image") }}" alt="Photo" style="max-height: 260px;">
                        </div>
                        <div class="col px-4">
                            <div>
                                <div class="float-right">{{ $movie->lanchYear }} LanchYear</div>
                                <h3>{{ $movie->title }}</h3>
                                <p class="mb-0">{{ $movie->summery }}</p>
                                <p class="card-text">{{ $movie->duration }} Hours</p>

                                <a href="{{ route('review.show', $movie->id) }}" class="btn btn-warning">Show Reviews</a>
                                <a href="{{ route('movi.edit', $movie->id) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url('movi/' . $movie->id . '/delete') }}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
