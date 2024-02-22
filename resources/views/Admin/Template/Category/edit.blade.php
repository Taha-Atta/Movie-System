@extends('Admin.Template.base')


@section('content')
@include('errors')
<div class="container mt-5">
    @if (session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Edit Category
                            <a href="{{route('categories.index')}}" class="btn btn-primary float-end ml-3">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('categories.update',$category->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for=""> Name</label>
                                <input type="text" name="name" value="{{$category->name}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Categories</label>
                                <select name="categories"   class="form-control" >

                                    @foreach ($categories as $category )
                                    <option value="{{$category->id}}"

                                    {{-- {{in_array($categorys,$sunbCategories) ? 'selected': ''}} --}}
                                    >{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection