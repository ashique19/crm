<form action="{{ route('account.appointments.updateAppointment') }}" method="POST">
<div class="col-sm-12">
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        @csrf()
        <input type="hidden" name="appmt_id" id="appmt_id" value="{{$appointment->id}}">
        <input type="hidden" name="redirect" id="redirect" value="calendar">
        <label for="first-name" class="col-form-label">First Name:</label>
        <input type="text" value="{{$appointment->first_name}}" name="first_name" class="form-control" id="first-name" >
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="last-name" class="col-form-label">Last Name:</label>
        <input type="text" value="{{$appointment->last_name}}" name="last_name" class="form-control" id="last-name" >
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="email" class="col-form-label">Email:</label>
        <input type="text" value="{{$appointment->email}}" name="email" class="form-control" id="email" >
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="phone" class="col-form-label">Phone:</label>
        <input type="text" value="{{$appointment->phone}}" name="phone" class="form-control" id="phone" >
      </div>
    </div>
     <div class="col-sm-6">
      <div class="form-group">
        <label for="availability" class="col-form-label">Appointment Availability:</label>
        <select class="form-control" id="availability" name="availability" >
            @foreach($appointment_availability as $appointment_availability)
              <option value="{{$appointment_availability->id}}" @if($appointment_availability->id == $appointment->appointment_availability_id) ? selected : '' @endif >{{date('m/d/Y h:i a',strtotime($appointment_availability->availability))}}</option>
            @endforeach
        </select>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="service" class="col-form-label">Appointment Service:</label>
        <select class="form-control" name="service" id="service" >
           @foreach($appointment_services as $appointment_services)
              <option value="{{$appointment_services->id}}" @if($appointment_services->id == $appointment->appointment_service_id) ? selected : '' @endif >{{$appointment_services->name}}</option>
            @endforeach
        </select>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="type" class="col-form-label">Appointment Type:</label>
        <select class="form-control" name="type" id="type"  >
            <option @if($appointment->appointment_type == 1) ? selected : '' @endif value="1">In-person</option>
            <option @if($appointment->appointment_type== 2) ? selected : '' @endif value="2">Webcam</option>
            <option @if($appointment->appointment_type== 3) ? selected : '' @endif value="3">Phone</option>
            <option @if($appointment->appointment_type== 4) ? selected : '' @endif value="4">Messaging</option>
        </select>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="type" class="col-form-label">Status:</label>
        <select class="form-control" name="active" id="active"  >
          <option @if($appointment->active == 1) ? selected : '' @endif value="1">Confirmed</option>
          <option @if($appointment->active == 0) ? selected : '' @endif value="0">Cancelled</option>
           
        </select>
      </div>
    </div>
     <div class="col-sm-12">
     <button type="submit" name="save_appmt" class="btn btn-primary">
          Update
      </button>
    </div>
  </div>
</div>
</form>
<script type="text/javascript">
   $(document).ready(function(){
      $('#phone').inputmask("(999) 999-9999");
    });
</script>