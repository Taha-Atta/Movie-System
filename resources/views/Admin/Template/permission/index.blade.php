@extends('Admin.Template.base')
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Permissions
                        </h4>
                        <a href="{{url('permissions/create')}}" class="btn btn-success float-end">Create New Permission</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission )
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name }}</td>
                                    <td>
                                        <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('permissions/'.$permission->id.'/delete')}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{$permissions->links()}}
            </div>
        </div>
    </div>
@endsection