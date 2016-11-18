{{-- hidden --}}
<input type="hidden" id="standData{{$stand->id}}" value="{{json_encode($stand)}}">
<input type="hidden" id="standAddress{{$stand->id}}" value="{{json_encode($stand->address)}}">
<div class="map col m6 l4">
    <div id="standMap{{$stand->id}}" class="standMap" style='width: 250px; height: 250px; border: solid 1px;'></div>
</div>

<div class="col s8 push-s2 m5 l5 push-l1">
    <p class="center-align">{{$stand->description}}</p>
</div>
<br>
<div class="col s8 push-s2 m5 l5 push-l1">
    <p class="center-align">
        {{$stand->address->address}}<br>
        {{$stand->address->city}}, {{$stand->address->state}} {{$stand->address->zip}}
    </p>
</div>