<div class="col s8 push-s2 m4 l3">
    <div class="card">
        <div class="card-image">
            <img src='{{asset("img/tomato.jpg")}}' alt="">
            <span class="card-title blue-text" id="product_name-{{$product->id}}">{{$product->name}}</span>
        </div>
        <div class="card-content">
            <p id="product_description-{{$product->id}}">{{$product->description}}</p>
            <p>In Stock: 
                <span id="product_stock-{{$product->id}}">{{$product->stock}}</span>
            </p>
            <p id="product_price-{{$product->id}}">${{$product->price}}</p>
        </div>
        <div class="card-action">
            <a class="add-to-cart" id="product_id-{{$product->id}}"  href="{{url('/cart/add/'.$product->id)}}">Add To Cart</a>
            @if(isset($edit) && $edit == true)
                <a href="#0" class="edit-product" id="product_edit-{{$product->id}}">Edit Product</a>
            @endif
        </div>
    </div>
</div>