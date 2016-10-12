<div class="col s8 push-s2 m4 l3">
    <div class="card">
        <div class="card-image">
            <img src="http://feelgrafix.com/data_images/out/27/956607-tomato.jpg" alt="">
            <span class="card-title blue-text">{{$product->name or 'Tomato'}}</span>
        </div>
        <div class="card-content">
            <p>{{$product->description or 'Buy This'}}</p>
            <p>In Stock: {{$product->stock or '3'}}</p>
            <p>${{$product->price or '5.00'}}</p>
        </div>
        <div class="card-action">
            <a href="{{url('/cart/add/'.$product->id)}}">Add To Cart</a>
        </div>
    </div>
</div>