<div class="col s8 push-s2 m4 l3">
    <div class="card">
        <div class="card-image">
            <img src="http://feelgrafix.com/data_images/out/27/956607-tomato.jpg" alt="">
            <span class="card-title blue-text">{{$product->name or 'Tomato'}}</span>
        </div>
        <div class="card-content">
            <p>{{$product->description or 'Buy This'}}</p>
        </div>
        {{-- Stock and price somewhere --}}
        <div class="card-action"><a href="">Add To Cart</a></div>
    </div>
</div>