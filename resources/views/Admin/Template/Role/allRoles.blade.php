@extends('Admin.Template.base')


@section('content')
    @include('success')
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>The Role Name </th>
                    <th>permission Of Role</th>
                    <th>Delete Role</th>
                    <th>Edit Role</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($roles as $role )
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$role->name}}</td>
                    <td>{{$role->name}}</td>
                    {{-- @foreach ($user->getAllPermissions() as $permissions )

                    <td>{{$permissions->name}}</td>
                    @endforeach --}}
                    <td>
                        <form action="{{route('roles.destroy',$role->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <h6><a class="btn btn-success" href="{{url("roles/$role->id/edit")}}">Edit</a></h6>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
