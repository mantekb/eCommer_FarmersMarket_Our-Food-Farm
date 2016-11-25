@extends('layouts.default')

@section('title', 'New Learning Resource')

@section('content')

<h2>New Learning Resource</h2>

<form class="form-horizontal" role="form" method="POST" action="{{ url('/newarticle') }}">
<div class="card">
    <div class="card-content">
        <div class="card-title"></div>
        
            {{ csrf_field() }}

            <div class="input-field">
                <label for="title">Title</label>

                <input id="title" type="text" class="form-control" name="title" >
            </div>
        
        <div class="card-title"></div>
        
            {{ csrf_field() }}

            <div class="input-field">
                <textarea id="textarea1" class="materialize-textarea"></textarea>
         		<label for="content">Content</label>
            </div>
        
    </div>
</div>

<div class="row">
    <div class="col s1 m1">
        <div class="card">
            <div class="input-field">
                <button type="submit" id="submitpayinfo" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
</form>
@endsection