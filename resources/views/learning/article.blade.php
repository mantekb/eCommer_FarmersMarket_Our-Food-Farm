@extends('layouts.default')

@section('title', 'Article')

@section('content')

<div> 
		<span class="center">
			<div class="responsive image">
          <img src="https://irp-cdn.multiscreensite.com/a730bec6/dms3rep/multi/tablet/tomatoe3-948x710.jpg" alt="" height="80%" width="40%">
          <div class="card">
            <div class="card-content">
              <span class="card-title"><h4>{{$article->title}}</h4></span>
              <a href="{{url("/stand/".$article->user->stand->id)}}">By: {{$article->user->name}}</a>
              <p>{{$article->content}}</p><br>
            </div>
          </div>
          
      </div>
    </span>
</div>

@endsection