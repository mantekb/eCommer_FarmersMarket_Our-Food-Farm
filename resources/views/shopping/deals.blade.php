@extends("layouts.default")

@section('title', 'Deals Of The Day')

@section('content')

{{-- Placeholders below --}}
<div class="row">
    <div class="col s12">
        <h2>Deals Of The Day:</h2>
    </div>
</div>

<div class="grid row">
    @foreach($products as $product)
        @include('stand.product-card', ['product' => $product])
    @endforeach
</div>

@endsection