@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

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
            <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$post->id}}">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" value="{{$post->title}}">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" name="description">{{$post->description}}</textarea>
                </div>
                @if($post->image == "")
                @php
                $post->image = "Small-Business-Website-Design-1080x628%20copy.jpg"
                @endphp
                @endif
                <img src="{{asset('/storage/images/'.$post->image)}}" width="50">
                <input type="file" name="image">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection