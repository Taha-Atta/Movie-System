@extends('Admin.Template.base')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left">
                <h2>Permission Management
                    <div class="float-end">
                        {{-- @can('role-create') --}}
                            <a class="btn btn-success" href="{{route('permissions.create')}}"> Create New Permission</a>
                        {{-- @endcan --}}
                    </div>
                </h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-striped table-hover">
        <tr>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('permissions.show', $permission->id) }}">Show</a>
                        {{-- @can('role-edit') --}}
                            <a class="btn btn-primary" href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
                        {{-- @endcan --}}


                        @csrf
                        @method('DELETE')
                        {{-- @can('product-delete') --}}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        {{-- @endcan --}}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
{{--
    {!! $roles->render() !!} --}}
@endsection