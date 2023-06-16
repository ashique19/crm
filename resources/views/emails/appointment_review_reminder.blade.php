@extends('layouts.email')
@section('title')
Appointment Review Reminder
@endsection

@section('content')

<h4>Appointment Review Reminder</h4>
 
Please click this  <a href="{{ $data['link'] }}">link</a> to write a review for your appointment.


@endsection
