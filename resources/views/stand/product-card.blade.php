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
            <p>$<span id="product_price-{{$product->id}}">{{$product->price}}</span></p>
        </div>
        <div class="card-action">
        @if(isset($edit) && $edit == true)
            <a href="#product_modal-{{$product->id}}" class="edit-product modal-trigger" id="product_edit-{{$product->id}}">Edit Product</a>
        @else
            <a class="add-to-cart" id="product_id-{{$product->id}}"  href="{{url('/cart/add/'.$product->id)}}">Add To Cart</a>
        @endif
        </div>
    </div>
</div>