@extends('Admin.Template.base')

@section('content')
@include('errors')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Create Movie
                            <a href="{{route('movi.index')}}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('movi.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="">Movie Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="description">Summery:</label>
                                <textarea name="summery" id="summery" class="form-control"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="images">Images:</label>
                                <input type="file" name="image"  id="images"class="form-control" >
                            </div>
                            <div class="mb-3">
                                <label for="video">Video:</label>
                                <input type="file" name="video" class="form-control" id="video">
                            </div>
                            <div class="mb-3">
                                <label for="">Movie Duration</label>
                                <input type="number" name="duration" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Movie lanchYear</label>
                                <select name="lanchYear" id="lanchYear" class="form-select">
                                    @for ($year = date('Y'); $year >= 1900; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Movie isFree</label>
                                <select name="isFree" id="">
                                    <option value="1">Free</option>
                                    <option value="0">Paid</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Categories</label>
                                <select name="category" class="form-control" >

                                    @foreach ($categories as $category )
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
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