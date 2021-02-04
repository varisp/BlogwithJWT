@extends('layouts.app')

@section('content')
<div class="container">


    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-sm-6">
        <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description">{{old('description')}}</textarea>
            </div>

            <input type="file" name="image">
            <button type="submit">Submit</button>
        </form>
    </div>

</div>
@endsection