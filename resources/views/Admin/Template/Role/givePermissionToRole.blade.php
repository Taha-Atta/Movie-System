@extends('Admin.Template.base')

@section('content')
@include('errors')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
                @include('success')
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>  Role : {{$role->name}}
                            <a href="{{url('roles')}}" class="btn btn-primary float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="{{url('roles/'.$role->id.'/givePermissionToRole')}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label>Permissions</label>
                                <div class="row">
                                    @foreach ($permissions as $permission)

                                    <div class="col-md-4">
                                        <label >
                                            <input type="checkbox" name="permission[]"
                                            value="{{$permission->name}}"
                                            {{in_array($permission->id,$rolePermission) ? 'checked' : ''}}

                                            />
                                            {{$permission->name}}
                                        </label>

                                    </div>
                                    @endforeach
                                </div>
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
