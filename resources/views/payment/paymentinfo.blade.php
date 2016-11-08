@extends('layouts.default')

@section('title', 'Payment Information')

@section('content')

<h2>Save Payment Information</h2>
<form class="form-horizontal" role="form" method="POST" action="{{ url('/payment') }}">
<div class="card">
    <div class="card-content">
        <div class="card-title">Legal First Name</div>
        
            {{ csrf_field() }}

            <div class="input-field">
                <label for="firstname">Legal First Name</label>

                <input id="firstname" type="text" class="form-control" name="firstname">
            </div>
        
        <div class="card-title">Legal Last Name</div>
        
            {{ csrf_field() }}

            <div class="input-field">
                <label for="lastname">Legal Last Name</label>

                <input id="lastname" type="text" class="form-control" name="lastname">
            </div>
        
    </div>
</div>

<div class="card">
    <div class="card-content">
        <div class="card-title">Debit Card Information</div>
        {{ csrf_field() }}

        <div class="input-field">
            <label for="cardNumber">Card Number</label>

            <input id="cardNumber" type="text" class="form-control" name="cardNumber">
        </div>

        <div class="input-field">
            <label for="expDate">Expiration Date</label>

            <input id="expDate" type="text" class="form-control" name="expDate">
        </div>

        <div class="input-field">
            <label for="cvc">CVC</label>

            <input id="cvc" type="text" class="form-control" name="cvc">
        </div>
        
    </div>
</div>

<div class="card">
    <div class="card-content">
        <div class="card-title">Date Of Birth</div>
        
            {{ csrf_field() }}

            <input id="DOB" type="date" class="datepicker" name="DOB">
        </div>
        
    </div>
</div>



<div class="card">
    <div class="card-content">
        <div class="card-title">Address</div>
        
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