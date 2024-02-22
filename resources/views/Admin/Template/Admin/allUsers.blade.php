@extends('Admin.Template.base')


@section('content')
    @include('success')
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Type</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user )
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->age}}</td>
                    <td>{{$user->type}}</td>
                    <td>
                        <form action="{{route('users.destroy',$user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                    <td>
                        <h6><a class="btn btn-success" href="{{url("users/$user->id/edit")}}">Edit</a></h6>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
