@extends('layouts.app')
@section('content')

    @if(strtolower(Config::get('app.name')))
        @include('frontend.sites.'.strtolower(Config::get('app.name')).'.about')
    @endif          

@endsection

@section('cta')
    @if(strtolower(Config::get('app.name')))
        @include('frontend.sites.'.strtolower(Config::get('app.name')).'.components.call_to_action')
    @endif 
@endsection