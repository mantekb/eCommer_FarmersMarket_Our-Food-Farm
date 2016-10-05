@extends("layouts.default")

@section('title', 'Deals Of The Day')

@section('content')

{{-- Placeholders below --}}
<div class="row">
    <div class="col s12">
        <h2>Deals Of The Day:</h2>
    </div>
</div>

<div class="row">
    @for($i = 0; $i < 12; $i++)
    <div class="col s8 push-s2 m4 l3">
        <div class="card">
            <div class="card-image">
                <img src="http://feelgrafix.com/data_images/out/27/956607-tomato.jpg" alt="">
                <span class="card-title blue-text">Tomato</span>
            </div>
            <div class="card-content">
                <p>Buy this</p>
            </div>
            <div class="card-action">
                <a href="">Add To Cart</a>
            </div>
        </div>
    </div>
    @endfor
</div>

@endsection