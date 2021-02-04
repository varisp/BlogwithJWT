
@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row content">
    <div class="col-sm-9">
    <h2>{{$post->title}}</h2>
        @if($post->image == "")
        @php
        $post->image = "Small-Business-Website-Design-1080x628%20copy.jpg";
      
        @endphp
        @endif
        <img src="{{asset('storage/images/'.$post->image)}}" height="400"><br><br>
      <h5><span class="glyphicon glyphicon-time"></span> Post by {{auth()->user()->name}}, {{$post->created_at}}.</h5>
      
      <p>{{$post->description}}</p>
      <br><br>
    
   
        
       
       
    </div>
</div>
@endsection
