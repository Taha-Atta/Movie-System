@extends('Admin.Template.base')

@section('content')
    @include('errors')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Update Review
                            <a href="{{ route('review.index') }}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                      
                        <form action="{{ route('review.update',$review->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="">Review stars</label>
                                <input type="number" name="stars" value="{{$review->stars}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Review Comment</label>
                                <textarea name="comment" id="comment" cols="30" rows="10" class="form-control">{{$review->comment}}</textarea>
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
