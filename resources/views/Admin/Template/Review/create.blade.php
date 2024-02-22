@extends('Admin.Template.base')

@section('content')
    @include('errors')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Create Review to {{$movie->title}} Movie
                        </h4>
                        <div class="">
                            <a href="{{ route('movi.show', $movie->id)}}" class="btn btn-info float-end">back</a>

                        </div>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('review/' . $movie->id . '/storee') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">Review stars</label>
                                <input type="number" name="stars" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Review Comment</label>
                                <textarea name="comment" id="comment" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
