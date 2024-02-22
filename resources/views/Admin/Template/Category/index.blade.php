@extends('Admin.Template.base')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Categories
                        </h4 class="position-relative">
                        <a href="{{url('categories/create')}}" class="btn btn-success float-end">Create New categry</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>ParentID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category )
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name }}</td>
                                    <td>{{$category->parent_id }}</td>
                                    <td>

                                        <a href="{{route('categories.edit', $category->id)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('categories/'.$category->id.'/delete')}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection