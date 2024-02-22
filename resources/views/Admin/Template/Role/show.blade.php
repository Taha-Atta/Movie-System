@extends('Admin.Template.base')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Role
                        </h4>
                        <a href="{{ url('roles') }}" class="btn btn-success float-end">back</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>{{ $role->name }}</td>
                                    <td>

                                      @foreach ($rolePermissions  as $rolpermission )

                                      <label class="badge bg-warning mx-1">{{$rolpermission->name}}</label>
                                      @endforeach


                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
