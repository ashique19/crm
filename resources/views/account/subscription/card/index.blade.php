@extends('layouts.app')

@section('title')
<title>Card</title>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/modules/modules-card.css') }}">   
<link href="{{ asset('assets/css/ui-kit/buttons/creative/creative-material.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="mr-5"><a href="{{ route('account.overview') }}">Account</a></li>
                    <li class="active"><a href="#">Update Credit Card</a> </li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Update Credit Card</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">    
    
    @include('account.settings.partials.account_navigation')
    
    <div class="col-sm-9 col-12 mb-sm-0">  
    
    
        <div class="widget-content-area social-likes text-center p-0 br-4">
            <div class="card facebook br-4">
                <div class="icon mb-4">
                    <i class="flaticon-credit-card"></i>
                </div>
                <div class="card-content">
                    <h5>Update Credit Card</h5>             
                    
                    <form action="{{ route('account.subscription.card.store') }}"method="post" id="card-form">
                        @csrf

                        <p>Click below to securely update your credit card</p>

                        <div class="form-group row mb-3">
                            <div class="col-md-12">
                                <button type="submit" class="btn-material btn-rounded btn-material-primary  mb-4 mr-3" id="update">
                                    Update Credit Card
                                </button>
                            </div>
                        </div>
                    </form>                    
                </div>
            </div>
        </div>      




    </div>
</div>     
@endsection

@section('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        let handler = StripeCheckout.configure({
            key: '{{ config('services.stripe.key') }}',
            locale: 'auto',
            token: function (token) {
                let form = $('#card-form');

                $('#update').prop('disabled', true);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'token',
                    value: token.id
                }).appendTo(form);

                form.submit();
            }
        });

        $('#update').click(function (e) {
            handler.open({
                name: '{{ config('saas.stripe.name') }}',
                currency: '{{ config('saas.stripe.currency') }}',
                key: '{{ config('services.stripe.key') }}',
                email: '{{ auth()->user()->email }}',
                panelLabel: 'Update Card'
            });

            e.preventDefault();
        })
    </script>
@endsection
