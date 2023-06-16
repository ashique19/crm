@if(count($appointment_avails)>0)
@foreach($appointment_avails as $key => $appointment_avail)
    <div class="slots-1">
        <div class="custom-control custom-radio pl-0">
            <input type="radio" value="{{$appointment_avail->id}}" name="appointment_availability" class="custom-control-input" id="customRadio{{$key}}" required>
            <label class="custom-control-label" for="customRadio{{$key}}">{{ Carbon\Carbon::parse($appointment_avail->availability)->format('m/d/Y h:i a') }}</label>
        </div>
    </div>
@endforeach
@else
<p>No availability for {{$date}}</p>
@endif