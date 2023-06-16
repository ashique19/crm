@extends('layouts.email')
@section('title')
Contact Form
@endsection

@section('content')
<h3>{{$name}} wants to contact with you</h3>

<p><strong>Name:</strong> {{ $name}}</p>
<p><strong>Email:</strong> {{ $email}}</p>
<p><strong>Subject:</strong> {{ $subject}}</p>
<p><strong>Message:</strong> {{ $bodyMessage}}</p>
@endsection

