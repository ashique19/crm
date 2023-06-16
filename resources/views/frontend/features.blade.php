@extends('layouts.app')

@section('content')

    @if(strtolower(Config::get('app.name')))
        @include('frontend.sites.'.strtolower(Config::get('app.name')).'.features')
    @endif 

@endsection
