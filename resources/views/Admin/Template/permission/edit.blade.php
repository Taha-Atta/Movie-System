@extends('Admin.Template.base')

@section('content')
@include('errors')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Edit Permission
                            <a href="{{url('permissions')}}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('permissions.update',$permission->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="">Permission Name</label>
                                <input type="text" name="name" value="{{$permission->name}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection