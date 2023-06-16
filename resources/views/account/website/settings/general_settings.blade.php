@extends('layouts.app')

@section('title')
<title>General Settings</title>
@endsection

@section('styles')
<link href="{{ asset('assets/plugins/timepicker/jquery.timepicker-1.3.5.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/plugins/date_time_pickers/custom_datetimepicker_style/custom_datetimepicker.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('assets/css/pages/design.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/custom-page_style_datetime.css') }}">
@endsection
@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
   <div class="col-sm-12">
      <div class="page-title-box">
         <div class="crumbs float-right">
            <ul id="breadcrumbs" class="breadcrumb">
               <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
               <li class="active"><a href="#">General Settings</a> </li>
            </ul>
         </div>
         <h4 class="page-title"> <i class="fa fa-tachometer"></i> General Settings</h4>
      </div>
   </div>
</div>
<!-- end page title end breadcrumb -->
@endsection
@section('content')
<div class="row">
   @include('account.website.settings.partials.setting_navigation')
   <div class="col-sm-9 col-12 mb-sm-0">
      <div class="widget-content widget-content-area h-100 br-4 p-0">
         <div id="user-profile-card-3" class="card br-4">
            <div class="card-header">
               <div class="row">
                  <div class="col-sm-12">
                     <h6 class="mt-2">Business Information</h6>
                  </div>
                  <div class="col-sm-12">
                       @if (\Session::has('success'))
                           <div class="alert alert-success">
                               <ul class="nav">
                                   <li>{!! \Session::get('success') !!}</li>
                               </ul>
                           </div>
                       @endif
                   </div>
               </div>
            </div>
            <div class="card-body">
               <form class="" action="{{ route('account.website.generalsetting.store') }}" method="post" >
                  <div class="row">
                      @csrf()
                       <input type="hidden" name="site_id" value="{{ $site->id }}">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Name</label>
                           <input type="text" class="form-control" name="business_name" required="" value="{{ $site->business_name }}">
                        </div>
                        <div class="form-group">
                           <label>Phone</label>
                           <input type="text" class="form-control business_phone" name="business_phone" required="" value="{{ $site->business_phone }}">
                        </div>
                        <div class="form-group">
                           <label>Email</label>
                           <input type="email" class="form-control" name="business_email"  value="{{ $site->business_email }}" required >
                        </div>
                        <div class="form-group">
                           <label>Address</label>
                           <input type="text" class="form-control" name="business_address1" required="" value="{{ $site->business_address }}">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Address 2</label>
                           <input type="text" class="form-control" name="business_address2" required="" value="{{ $site->business_address_2 }}">
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>City</label>
                                 <input type="text" class="form-control" name="business_city" required="" value="{{ $site->business_city }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>State Or Province</label>
                                 <input type="text" class="form-control" name="business_state" required="" value="{{ $site->business_state }}">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Zip Or Postal Code</label>
                                 <input type="text" class="form-control" name="business_zip" required="" value="{{ $site->business_zip }}">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Country</label>
                                 <select class="form-control" name="business_country">
                                    <option value="">Select</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $site->business_country==$country->id?'selected':'' }}>{{$country->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
            </div>
         </div>


         <div class="widget-content widget-content-area h-100 br-4 p-0">
            <div id="user-profile-card-3" class="card br-4">
               <div class="card-header">
                  <div class="row">
                     <div class="col-sm-12">
                        <h6 class="mt-2">Business Hours</h6>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <form class="" action="#" novalidate="">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Monday Hours</label>
                              <select id="mondayHours" name="mondayHours" class_attr="openMonday" class="form-control hours_change" required="">
                                 <option value="0">Closed</option>
                                 <option value="1" {{ $site->monday=='1'?'selected':'' }} >Open</option>
                              </select>
                              <div id="openMonday" class="colors" style="display:{{$site->monday=='1'?'block':'none'}};">
                                 Start Time: <input type="text" class="form-control timepicker" name="monday_start" value="{{ Carbon\Carbon::parse($site->monday_start)->format('g:i A') }}" autocomplete="off">
                                 End Time: <input type="text" class="form-control timepicker" name="monday_end" value="{{ Carbon\Carbon::parse($site->monday_end)->format('g:i A') }}" autocomplete="off">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Tuesday Hours</label>
                              <select id="tuesdayHours" name="tuesdayHours" class_attr="openTuesday" class="form-control hours_change" required="">
                                 <option value="0">Closed</option>
                                 <option value="1" {{ $site->tuesday=='1'?'selected':'' }}>Open</option>
                              </select>
                              <div id="openTuesday" class="colors" style="display:{{$site->tuesday=='1'?'block':'none'}}">
                                 Start Time: <input type="text" class="form-control timepicker" name="tuesday_start" value="{{ Carbon\Carbon::parse($site->tuesday_start)->format('g:i A') }}" autocomplete="off">
                                 End Time: <input type="text" class="form-control timepicker" name="tuesday_end" value="{{ Carbon\Carbon::parse($site->tuesday_end)->format('g:i A') }}" autocomplete="off">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Wednesday Hours</label>
                              <select id="wednesdayHours" name="wednesdayHours" class="form-control hours_change" class_attr="openWednesday" required="">
                                 <option value="0">Closed</option>
                                 <option value="1" {{ $site->wednesday=='1'?'selected':'' }}>Open</option>
                              </select>
                              <div id="openWednesday" class="colors" style="display:{{$site->wednesday=='1'?'block':'none'}}">
                                 Start Time: <input type="text" class="form-control timepicker" name="wednesday_start" value="{{ Carbon\Carbon::parse($site->wednesday_start)->format('g:i A') }}" autocomplete="off">
                                 End Time: <input type="text" class="form-control timepicker" name="wednesday_end" value="{{ Carbon\Carbon::parse($site->wednesday_end)->format('g:i A') }}" autocomplete="off">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Thursday Hours</label>
                              <select id="thursdayHours" name="thursdayHours" class="form-control hours_change" class_attr="openThursday" required="">
                                 <option value="0">Closed</option>
                                 <option value="1" {{ $site->thursday=='1'?'selected':'' }}>Open</option>
                              </select>
                              <div id="openThursday" class="colors" style="display:{{$site->thursday=='1'?'block':'none'}}">
                                 Start Time: <input type="text" class="form-control timepicker" name="thursday_start" value="{{ Carbon\Carbon::parse($site->thursday_start)->format('g:i A') }}" autocomplete="off">
                                 End Time: <input type="text" class="form-control timepicker" name="thursday_end" value="{{ Carbon\Carbon::parse($site->thursday_end)->format('g:i A') }}" autocomplete="off">
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Friday Hours</label>
                              <select id="fridayHours" name="fridayHours" class="form-control hours_change" class_attr="openFriday" required="">
                                 <option value="0">Closed</option>
                                 <option value="1" {{ $site->friday=='1'?'selected':'' }}>Open</option>
                              </select>
                              <div id="openFriday" class="colors" style="display:{{$site->friday=='1'?'block':'none'}}">
                                 Start Time: <input type="text" class="form-control timepicker" name="friday_start" value="{{ Carbon\Carbon::parse($site->friday_start)->format('g:i A') }}" autocomplete="off">
                                 End Time: <input type="text" class="form-control timepicker" name="friday_end" value="{{ Carbon\Carbon::parse($site->friday_end)->format('g:i A') }}" autocomplete="off">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Saturday Hours</label>
                              <select id="saturdayHours" name="saturdayHours" class_attr="openSaturday" class="form-control hours_change" required="">
                                 <option value="0">Closed</option>
                                 <option value="1" {{ $site->saturday=='1'?'selected':'' }}>Open</option>
                              </select>
                              <div id="openSaturday" class="colors" style="display:{{$site->saturday=='1'?'block':'none'}}">
                                 Start Time: <input type="text" class="form-control timepicker" name="saturday_start" value="{{ Carbon\Carbon::parse($site->saturday_start)->format('g:i A') }}" autocomplete="off">
                                 End Time: <input type="text" class="form-control timepicker" name="saturday_end" value="{{ Carbon\Carbon::parse($site->saturday_end)->format('g:i A') }}" autocomplete="off">
                              </div>
                           </div>
                           <div class="form-group">
                              <label>Sunday Hours</label>
                              <select id="sundayHours" name="sundayHours" class="form-control hours_change" class_attr="openSunday" required="">
                                 <option value="0">Closed</option>
                                 <option value="1" {{ $site->sunday=='1'?'selected':'' }}>Open</option>
                              </select>
                              <div id="openSunday" class="colors" style="display:{{$site->sunday=='1'?'block':'none'}}">
                                 Start Time: <input type="text" class="form-control timepicker" name="sunday_start" value="{{ Carbon\Carbon::parse($site->sunday_start)->format('g:i A') }}" autocomplete="off">
                                 End Time: <input type="text" class="form-control timepicker" name="sunday_end" value="{{ Carbon\Carbon::parse($site->sunday_end)->format('g:i A') }}" autocomplete="off">
                              </div>
                           </div>
                         </div>
                        <div class="col-md-12">
                           <div class="form-group float-right">
                                 <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                 Cancel
                                 </button>
                                 <button type="submit" class="btn btn-primary waves-effect waves-light">
                                 Submit
                                 </button>								 
                           </div>
                         </div>						   
                  </form>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


      </div>


@endsection
@section('scripts')
<script src="{{ asset('assets/plugins/timepicker/jquery.timepicker-1.3.5.js') }}"></script>
<script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script>
   $(document).ready(function() {
       $('.hours_change').change(function(){
           $('#' + $(this).attr('class_attr')).toggle();
       });
       
      $('.business_phone').inputmask("(999) 999-9999");
      $('.timepicker').timepicker({
          timeFormat: 'h:mm p',
          dynamic: false,
          dropdown: true,
          scrollbar: true
      });
   });
</script>
@endsection