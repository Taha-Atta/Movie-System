@extends('Admin.Template.base')

@section('content')
    @include('errors')
    @include('success')
    <h3>Update User </h3>
    <div class="body p=20px">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <label for="email_address">Name</label>
            <div class="form-group">
                <input type="text" name="name" class="form-control" value ="{{ $user->name }}">
            </div>
            <label for="email_address">Email Address</label>
            <div class="form-group">
                <input type="email"  name="email" class="form-control" value ="{{ $user->email }}">
            </div>
            <label for="password">Password</label>
            <div class="form-group">
                <input type="password"   name="password" class="form-control" placeholder="Enter new password" >
            </div>
            <label for="type">type</label>
            <div class="form-group">
                <input type="number"  name="type" class="form-control" value ="{{ $user->type }}">
            </div>
            <label for="age">age</label>
            <div class="form-group">
                <input type="number"  name="age" class="form-control" value ="{{ $user->age }}">
            </div>
            @if ($user->type == 1)
                <label for="salary">salary</label>
                <div class="form-group">
                    <input type="text" name="salary" class="form-control" value ="{{ $user->salary }}">
                </div>
            @endif
            <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Submit</button>
        </form>
    </div>
@endsection
