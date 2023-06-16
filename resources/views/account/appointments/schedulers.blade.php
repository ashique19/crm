<div class="col-lg-12 col-md-12 col-sm-12 col-12 margin-bottom-25">
    <div class="row">
        @foreach($appointment_avails as $key=>$appointment_avail)
        <div class="scheduled-appointments-item col-2 margin-bottom-25">
            @if(!is_null($appointment_avail->appointments))
                @if($appointment_avail->appointments->appointment_services->color)
                    @php
                    $b_color = $appointment_avail->appointments->appointment_services->color;
                    @endphp
                @else
                    @php $b_color = 'primary'; @endphp
                @endif
            <button class="btn btn-meeting btn-gradient-{{ $b_color  }} btn-block">{{$appointment_avail->appointments->appointment_services->name}}<br>{{ Carbon\Carbon::parse($appointment_avail->availability)->format('H:i a') }}</button>
            <div class="meeting-profile meeting-profile-3 mt-2 text-center">
                <h6 class="mt-2 fg-blue">
                    <span>{{ $appointment_avail->appointments->first_name.' '.$appointment_avail->appointments->last_name}}</span>
                </h6>
                <h6 class="mt-2 fg-blue">
                    <span>{{ $appointment_avail->appointments->email}}</span>
                </h6>
                <h6 class="mt-2 fg-blue">
                    <span>{{ $appointment_avail->appointments->phone}}</span>
                </h6>
                <p>{{ Carbon\Carbon::parse($appointment_avail->availability)->format('m/d/Y ') }}</p>
                <p>{{ Carbon\Carbon::parse($appointment_avail->availability)->format('h:i a') }}</p>

                <h6><i class="flaticon-star"></i> Notifications</h6>
                <div class="a-slots">
                    <div class="slots-1">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="sms_notification" class="custom-control-input" value="1" id="sms_notification{{ $appointment_avail->appointments->id}}" {{ $appointment_avail->appointments->sms_notification == 1 ? 'checked':''}} >
                            <label class="custom-control-label" for="sms_notification{{ $appointment_avail->appointments->id}}">Sms Notification</label>
                        </div>
                    </div>
                    <div class="slots-1">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="email_notification" value="1" id="email_notification{{ $appointment_avail->appointments->id}}" {{ $appointment_avail->appointments->email_notification == 1 ? 'checked':''}} >
                            <label class="custom-control-label" for="email_notification{{ $appointment_avail->appointments->id}}">Email Notification</label>
                        </div>
                    </div>
                </div>
                <h6><i class="flaticon-star"></i> Appointment-Type</h6>
                <label for="appointment_type{{ $appointment_avail->appointments->id}}" class="sr-only">Appointment-Type</label>
                <select name="appointment_type" class="custom-select mr-sm-2" id="appointment_type{{ $appointment_avail->appointments->id}}" required>
                    <option value="">Choose..</option>
                    <option value="1" {{ $appointment_avail->appointments->appointment_type == 1 ? 'selected':''}}>In-person</option>
                    <option value="2" {{ $appointment_avail->appointments->appointment_type == 2 ? 'selected':''}}>Webcam</option>
                    <option value="3" {{ $appointment_avail->appointments->appointment_type == 3 ? 'selected':''}}>Phone</option>
                    <option value="4" {{ $appointment_avail->appointments->appointment_type == 4 ? 'selected':''}}>Messaging</option>
                </select>
                <div class="padding15">
                    <p class="ajax_saved" style="display: none;">Data Saved.</p>
                    <button class="btn btn-gradient-warning btn-rounded btn-md update_apmnt" apmnt_id={{ $appointment_avail->appointments->id}}>Update</button>
                </div>
            </div>
            @elseif(!empty($service_id))
                <button class="btn btn-outline-default btn-gradient btn-block apmnt_add_modal" service_id="{{ $service_id }}" avail_id="{{ $appointment_avail->id }}">
                    {{$appointment_service->name}}
                    <br>{{ Carbon\Carbon::parse($appointment_avail->availability)->format('H:i a') }}
                </button>
            @else
                <button class="btn btn-outline-default btn-gradient btn-block apmnt_add_modal" service_id="" avail_id="{{ $appointment_avail->id }}">
                    
                    <br>{{ Carbon\Carbon::parse($appointment_avail->availability)->format('H:i a') }}
                </button>
            @endif

        </div>
        @endforeach
    </div>
</div>
<script type="text/javascript">
    $('.apmnt_add_modal').click(function(){
        var service_id = $(this).attr('service_id');
        var avail_id = $(this).attr('avail_id');
        
        $('#service_id').val(service_id);
        $('#avail_id').val(avail_id);
        $('#avail_id_without_service').val(avail_id);
        if(service_id==""){
            $('#add_apnmt_modal_without_service').modal();
        }else{
            $('#add_apnmt_modal').modal();
        }
       
    });
    $('.update_apmnt').click(function(){
        var apmnt_id = $(this).attr('apmnt_id');
        if ($('#sms_notification'+apmnt_id).is(":checked"))
        {
          var sms_notification = $('#sms_notification'+apmnt_id).val();
        }else{
          var sms_notification = 0;
        }

        if ($('#email_notification'+apmnt_id).is(":checked"))
        {
          var email_notification = $('#email_notification'+apmnt_id).val();
        }else{
          var email_notification = 0;
        }

        var appointment_type = $('#appointment_type'+apmnt_id).find(":selected").val();
        
        $.ajax({
            url: "{{ route('account.appointments.update_scheduler') }}",
            data: {'apmnt_id': apmnt_id,'email_notification': parseInt(email_notification),'sms_notification': parseInt(sms_notification),'appointment_type': parseInt(appointment_type),'_token': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            success:function(res){
                $(".ajax_saved").show().delay(3000).fadeOut();
            }
        });
    });
    
</script>