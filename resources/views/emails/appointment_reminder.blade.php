@extends('layouts.email')
@section('title')
Appointment Reminder
@endsection

@section('content')

<h4>Appointment Reminder</h4>
<p>This is a reminder that you have an appointment with {{ $data['first_name'] }} {{ $data['last_name'] }} on {{ $data['availability'] }}</p>

@endsection
