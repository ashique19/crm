@extends('layouts.email')

@section('title')

@endsection

@section('content')

<h1>Hi, {{ $data->user->name }}</h1>

<p>We are sorry but your latest payment attempt has failed. Please login to the system and update the credit card on file to remit payment.</p>

<p>Thank You</p>
<p><strong>{{ Config::get('app.name') }}</strong></p>

@endsection