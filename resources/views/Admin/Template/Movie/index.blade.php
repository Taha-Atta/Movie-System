@extends('Admin.Template.base')
@section('content')
{{-- <div class="container-fluid">
    <h2 class="text-center display-4">Search</h2>
  </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="{{url('movi/search')}}" method="get">
                <div class="input-group input-group-lg">
                    <input type="search" class="form-control form-control-lg" name="key" placeholder="Type category" value="{{old('key')}}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="row mt-3">
        <div class="col-md-10 offset-md-1">
            <div class="list-group">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col px-4">
                            <div>
                                <div class="float-right">2021-04-20 04:04pm</div>
                                <h3>Lorem ipsum dolor sit amet</h3>
                                <p class="mb-0">consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            <img class="img-fluid" src="{{asset('../../dist/img/photo1.png')}}" alt="Photo" style="max-height: 160px;">
                            <iframe width="240" height="160" src="https://www.youtube.com/embed/WEkSYw3o5is?controls=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" class="border-0" allowfullscreen></iframe>
                        </div>
                        <div class="col px-4">
                            <div>
                                <div class="float-right">2021-04-20 10:14pm</div>
                                <h3>Lorem ipsum dolor sit amet</h3>
                                <p class="mb-0">consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            <iframe width="240" height="160" src="https://www.youtube.com/embed/WEkSYw3o5is?controls=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" class="border-0" allowfullscreen></iframe>
                        </div>
                        <div class="col px-4">
                            <div>
                                <div class="float-right">2021-04-20 11:54pm</div>
                                <h3>Lorem ipsum dolor sit amet</h3>
                                <p class="mb-0">consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}

    <div class="container mt-3">
        <div class="row">
            <div class="col-md-15">
                @include('success')
                <div class="card mt-2">
                    <div class="card-header">
                        <h4>Movies

                            <a href="{{route('movi.index')}}" class="btn btn-primary float-end">back</a>
                        </h4>
                        <br>
                        <div class="">
                            <a href="{{url('movi/create')}}" class="btn btn-success float-end">Create New Movie</a>
                        </div>
                        <br>
                        <form class="d-flex" action="{{url('search')}}" method="GET">
                            @csrf
                            <input class="form-control me-2" type="search" placeholder="Search by category" name="key" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Summery</th>
                                    <th>Duration</th>
                                    <th>LanchYear</th>
                                    <th>IsFree</th>
                                    <th>Categories</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $movie )
                                <tr>
                                    <td>{{$movie->id}}</td>
                                    <td>{{$movie->title }}</td>
                                    <td>{{$movie->summery }}</td>
                                    <td>{{$movie->duration }} Hours</td>
                                    <td>{{$movie->lanchYear }}</td>
                                    <td>{{$movie->isFree }}</td>
                                    <td>
                                        @if (!empty($movie->categories))
                                            @foreach ($movie->categories as $category )
                                            <label class="badge bg-warning mx-1">{{$category->name}}</label>
                                            @endforeach

                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('movi.show', $movie->id)}}" class="btn btn-success m-1">Show Viedo</a>
                                        <a href="{{route('movi.edit', $movie->id)}}" class="btn btn-primary">Edit</a>
                                        <a href="{{url('movi/'.$movie->id.'/delete')}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{$movies->links()}}

            </div>
        </div>
    </div>

@endsection