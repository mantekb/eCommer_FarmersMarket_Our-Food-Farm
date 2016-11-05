@extends('layouts.default')

@section('title', 'Payment Information')

@section('content')

<h2>Save Payment Information</h2>
<div class="card">
    <div class="card-content">
        <div class="card-title">Legal First Name</div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/payment/name') }}">
            {{ csrf_field() }}

            <div class="input-field">
                <label for="name">Legal First Name</label>

                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}">
            </div>
        </form>
        <div class="card-title">Legal Last Name</div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/payment/name') }}">
            {{ csrf_field() }}

            <div class="input-field">
                <label for="name">Legal Last Name</label>

                <input id="name" type="text" class="form-control" name="name">
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <div class="card-title">Date Of Birth</div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/payment/DOB') }}">
            {{ csrf_field() }}

                <input type="date" class="datepicker">
            </div>
        </form>
    </div>
</div>



<div class="card">
    <div class="card-content">
        <div class="card-title">Address</div>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/settings/address') }}">
            {{ csrf_field() }}
            <div class="input-field">
                <label for="address">Address</label>

                <input id="address" type="text" class="form-control" name="address" value="{{$user->address->address or ''}}">

            </div>

            <div class="input-field">
                <label for="city">City</label>

                <input id="city" type="text" class="form-control" name="city" value="{{$user->address->city or ''}}">

            </div>

            <div class="input-field">
                <label for="state">State</label>

                <input id="state" type="text" class="form-control" name="state" value="{{$user->address->state or ''}}">

            </div>

            <div class="input-field">
                <label for="zip">ZIP</label>

                <input id="zip" type="text" class="form-control" name="zip" value="{{$user->address->zip or ''}}">

            </div>

        </form>
    </div>
</div>
<div class="row">
    <div class="col s1 m1">
        <div class="card">
            <div class="input-field">
                <button type="submit" id="Sumbit" class="btn btn-primary">
                    Sumbit
                </button>
            </div>
        </div>
    </div>
</div>
@endsection