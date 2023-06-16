@extends('layouts.app')

@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="description" content="{{ seo('description') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ seo('title') }}" />
    <meta property="og:image" content="{{ url('assets/images/sites/'.strtolower(Config::get('app.name')).'/box-1.png') }}" />
    <meta property="og:description" content="{{ seo('description') }}">
    <meta property="og:type" content="website" />  
@endsection

@section('splash')
    @if(strtolower(Config::get('app.name')))
        @include('frontend.sites.'.strtolower(Config::get('app.name')).'.components.pricing_top')
    @endif 
@endsection

@section('content')

    <div class="pricing-1 container mt-100">
        <div class="row mb-3">

        @foreach($plans as $plan)

                <div class="col-md-4">
                    <div class="block block-pricing @if($plan->featured ) block-raised @endif ">
                        <div class="table  @if($plan->featured ) table-primary @endif ">
                            <h6 class="category">{{ $plan->name }}</h6>
                            <h2 class="block-caption"><small>$</small>                                 
                                {{$plan->price}}<small>/mo</small>
                             </h2>
                            
                            <ul>    
                                    @foreach($plan->features->sortBy('sort_order')  as $feature)
                                        <li>{{ $feature->description }}</li>
                                    @endforeach                                                                                            
                            </ul> 
                                    <a  href="{{ route('subscription.index') }}?plan={{ $plan->slug  }}" class="btn btn-lg btn-block @if($plan->featured) btn-secondary @else btn-primary @endif ">Get Started</a>
                                 
                        </div> 
                    </div>
                </div>   

                    @endforeach
        </div>
    </div>
    
    @if(strtolower(Config::get('app.name')))
        @include('frontend.sites.'.strtolower(Config::get('app.name')).'.components.pricing')
    @endif 
@endsection


@section('cta')
    @if(strtolower(Config::get('app.name')))
        @include('frontend.sites.'.strtolower(Config::get('app.name')).'.components.call_to_action')
    @endif 
@endsection