@extends('Admin.Template.base')

@section('content')
@include('errors')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Create Category
                            <a href="{{route('categories.store')}}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('categories')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">Category Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Categories</label>
                                <select name="parent_id[]" multiple class="form-control" >

                                    @foreach ($categories as $Category )
                                    <option value="{{$Category->id}}">{{$Category->name}}</option>
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