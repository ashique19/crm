@extends('layouts.email')
@section('title')
Appointment Update
@endsection

@section('content')

<h1>Hi, {{ $data->first_name}} {{ $data->last_name}}</h1>

<p>Your appointment has been updated. Please review the details below:</p>

<p><strong>First Name:</strong> {{ $data->first_name}}</p>
<p><strong>Last Name:</strong> {{ $data->last_name}}</p>
<p><strong>Email:</strong> {{ $data->email}}</p>
<p><strong>Phone:</strong> {{ $data->phone}}</p>
<p><strong>Availability:</strong> {{ $data->appointment_avail?$data->appointment_avail->availability:''}}</p>
<p><strong>Service:</strong> {{ $data->appointment_services->name}}</p>
<p><strong>Type:</strong> {{ $data->appointment_types[$data->appointment_type]}}</p>
<p><strong>Status:</strong> {{ $data->active==1?'Active':'Inactive'}}</p>

<p>Thank You</p>
<p><strong>{{ Config::get('app.name') }}</strong></p>

@endsection
