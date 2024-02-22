@extends('Admin.Template.base')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>Permission Management
        <div class="float-end">
            <a class="btn btn-success" href="{{ url('addPermission') }}"> Create New permission</a>
        </div>
            </h2>
        </div>
    </div>
</div>


@include('success')


<table class="table table-bordered table-hover table-striped">
 <tr>
   <th>All Permission</th>
   <th>Group Name</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($permissions as $key => $permission)
  <tr>
    <td>{{ $permission->name }}</td>
    <td>{{ $permission->group_name }}</td>
    {{-- <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-secondary text-dark">{{ $v }}</label>
        @endforeach
      @endif
    </td> --}}
    <td>
       <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        <a class="btn btn-success" href="{{ route('users.destroy',$user->id) }}"> Delete</a>
    </td>
  </tr>
 @endforeach
</table>
@endsection
