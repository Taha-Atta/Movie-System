@extends('Admin.Template.base')


@section('content')
@include('errors')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4> Create User
                            <a href="{{route('users.index')}}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('users.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for=""> Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for=""> Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for=""> Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for=""> Type</label>
                                <input type="number" name="type" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for=""> Age</label>
                                <input type="number" name="age" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for=""> salary</label>
                                <input type="number" name="salary" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Roles</label>
                                <select name="roles[]" multiple class="form-control" >
                                    <option value="">Role Select :</option> <br>
                                    @foreach ($roles as $role )
                                    <option value="{{$role->name}}">{{$role->name}}</option>
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