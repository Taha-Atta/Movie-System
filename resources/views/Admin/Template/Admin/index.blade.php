@extends('Admin.Template.base')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Users
                        </h4>
                        <a href="{{url('users/create')}}" class="btn btn-success float-end">Create New user</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user )
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name }}</td>
                                    <td>{{$user->email }}</td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))

                                            @foreach ($user->getRoleNames() as $roleName )
                                            <label class="badge bg-warning mx-1">{{$roleName}}</label>
                                            @endforeach

                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary">Edit</a>

                                        {{-- @can('delete roles') --}}
                                        @role('super-admin')
                                        <a href="{{url('users/'.$user->id.'/delete')}}" class="btn btn-danger">Delete</a>
                                        {{-- @endcan --}}
                                        @endrole
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