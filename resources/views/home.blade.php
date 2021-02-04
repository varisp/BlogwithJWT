@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        
       
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                   
              
        <div class="col-sm-12"><a class="btn btn-primary float-right" href="{{url('create')}}">Add a post</a></div>
        <br>
        <br>
        <table class="table table-striped">
    <thead>
      <tr>
      <th>Sl.No</th>
        <th>Title</th>
        <th>Picture</th>
        <th>View</th>        
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @forelse($posts as $post)
       
        @if($post->image == "")
        @php
        $post->image = "Small-Business-Website-Design-1080x628%20copy.jpg";       
        @endphp
        @endif
        @php
        $count = 1;
        @endphp
    <tr>
        <td>{{$count++}}</td>
        <th>{{$post->title}}</th>
        <th><a href="{{route('view',['id'=>$post->id])}}">view</a></th>
        <th><img src="{{asset('/storage/images/'.$post->image)}}" width="50px"></th>
        <th><form action="{{route('delete',['id'=>$post->id])}}" method="post">@csrf<button class="btn btn-danger" type="submit">Delete</button></form>
        <a class="btn btn-primary" href="{{route('edit',['id'=>$post->id])}}">Edit</a></th>
        @empty
        <tr>
        <td colspan="5" class="text-center">No posts are there, Please   add a new post</td>
        </tr>
      </tr>
        
       
        
        
      
        @endforelse
        </table>
    </div>
</div>
@endsection
