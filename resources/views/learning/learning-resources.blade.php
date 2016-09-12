@extends('layouts.default')

@section('title', 'Learning Resources')

@section('content')

<div>
    @foreach($articles as $art)
        <div class="col s12 m6">
          <div class="card green darken-4">
            <div class="card-content white-text">
              <span class="card-title">{{$art['title']}}</span>
              <p>{{$art['excerpt']}}</p>
            </div>
            <div class="card-action">
              <a href="/article/{{--articleID--}}">Read This</a>
              <a href="/stand/{{--author--}}">By: {{$art['author']}}</a>
            </div>
          </div>
        </div>
    @endforeach
</div>

@endsection