@extends('layouts.default')

@section('title', 'Learning Resources')

@section('content')
   
  <h1>Articles</h1>
  <a class="btn btn-primary right" href="{{url("/newarticle")}}">Post a New Learning Resource</a>

      @foreach($articles as $article)
      <div class="card green darken-4">
          <div class="card-content white-text">
              <tr>
                <td> <span class="card-title">{{$article->title}}<br></span> </td>
                <td>{{$article->excerpt()}}</td>
              </tr>
              <div class="card-action">
              <a href="{{url("/learning/article/".$article->id)}}">Read This</a>
              <a href="{{url("/stand/".$article->user->stand->id)}}">By: {{$article->user->name}}</a>
              </div>
          </div>
        </div>
      @endforeach

@endsection
