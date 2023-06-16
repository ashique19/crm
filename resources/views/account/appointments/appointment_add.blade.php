<form action="{{ route('account.appointments.addAppointment') }}" method="POST">
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          @csrf()
          <input type="hidden" name="redirect" id="redirect" value="calendar">
          <label for="first-name" class="col-form-label">First Name:</label>
          <input type="text"  name="first_name" class="form-control" id="first-name" >
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="last-name" class="col-form-label">Last Name:</label>
          <input type="text"  name="last_name" class="form-control" id="last-name" >
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="email" class="col-form-label">Email:</label>
          <input type="text"  name="email" class="form-control" id="email" >
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="phone" class="col-form-label">Phone:</label>
          <input type="text"  name="phone" class="form-control" id="phone" >
        </div>
      </div> 
      <div class="col-sm-6">
        <div class="form-group">
          <label for="availability" class="col-form-label">Appointment Availability:</label>
          <select class="form-control" id="availability" name="availability" >
              @foreach($appointment_availability as $appointment_availability)
                <option value="{{$appointment_availability->id}}" @if($appointment_availability->id == $appointment_availability_id) ? selected : '' @endif >{{date('m/d/Y h:i a',strtotime($appointment_availability->availability))}}</option>
              @endforeach
          </select>
        </div>
    </div>   
      <div class="col-sm-6">
        <div class="form-group">
          <label for="service" class="col-form-label">Appointment Service:</label>
          <select class="form-control" name="service" id="service" >
             @foreach($appointment_services as $appointment_services)
                <option value="{{$appointment_services->id}}" >{{$appointment_services->name}}</option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label for="type" class="col-form-label">Appointment Type:</label>
          <select class="form-control" name="type" id="type"  >
              <option value="1">In-person</option>
              <option value="2">Webcam</option>
              <option value="3">Phone</option>
              <option value="4">Messaging</option>
          </select>
        </div>
      </div>
       <div class="col-sm-12">
       <button type="submit" name="save_appmt" class="btn btn-primary">
            Add
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