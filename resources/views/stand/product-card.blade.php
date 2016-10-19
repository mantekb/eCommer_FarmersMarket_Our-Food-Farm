<div class="col s8 push-s2 m4 l3">
    <div class="card">
        <div class="card-image">
            <img src='{{asset("img/tomato.jpg")}}' alt="">
            <span class="card-title blue-text">{{$product->name or 'Tomato'}}</span>
        </div>
        <div class="card-content">
            <p>{{$product->description or 'Buy This'}}</p>
            <p>In Stock: {{$product->stock or '3'}}</p>
            <p>${{$product->price or '5.00'}}</p>
        </div>
        <div class="card-action">
        {{-- remove this when we don't need the placeholder stuff anytmore --}}
        @if(isset($product->id))
            <a class="add-to-cart" id="product_id-{{$product->id}}"  href="{{url('/cart/add/'.$product->id)}}">Add To Cart</a>
        @else
            <a class="add-to-cart" id="product_id-1"  href="{{url('/cart/add/1')}}">Add To Cart</a>
        @endif
        </div>
    </div>
</div>