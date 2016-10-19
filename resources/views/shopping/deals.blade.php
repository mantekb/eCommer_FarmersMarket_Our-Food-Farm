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
                <h10><img src='{{asset("img/tomato.jpg")}}' alt=""></h10>
                <span class="card-title blue-text">Tomato</span>
            </div>
            <div class="card-content">
                <div>
                    <a href="{{url("/stand/1")}}">Stand Name</a>
                    <span class="right"><h6>Reviews: ★★★☆☆</h6></span>
                </div>
                <p>Description of the Item </p>
            </div>
            <div class="card-action">
                <a href="">Add To Cart</a>
                
            </div>
        </div>
    </div>

    @endfor
</div>

@endsection