@extends('layouts.app')

@section('title')
<title>Account Overview</title>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/modules/modules-card.css') }}">
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
                    <li class="active"><a href="#"> Account Overview</a> </li>
                </ul>
            </div>
            <h4 class="page-title"> <i class="fa fa-tachometer"></i> Account Overview</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection


@section('content')


<div class="row">

    @include('account.settings.partials.account_navigation')

    <div class="col-sm-9 col-12 mb-sm-0">

    @if(!auth()->user()->hasSubscription())

        <div class="card card-default">
            <div class="card-body">

                <div class="p-1 text-center">
                    <p>
                        Click below here to activate your plan
                    </p>
                </div>

                <div class="text-center p-2">
                    <a class="btn btn-success" href="{{ route('plans.index') }}">Plans</a>
                </div>

            </div>
        </div>
    @else

        <div class="row">

                <div class="col-md-4 col-lg-4 col-sm-4">

                        <div class="widget-content widget-content-area br-4 p-0">
                            <div id="user-profile-card-3" class="card br-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6 class="mt-2">Current Plan</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body text-center">

                                    <div class="usr-info-meta mt-4 mb-3">
                                        @subscriptionnotcancelled
                                        <h5 class="mb-1">{{ auth()->user()->plan->name }}</h5>
                                        @endsubscriptionnotcancelled
                                        @subscriptioncancelled
                                        <h5 class="mb-1">N/A</h5>
                                        @endsubscriptioncancelled
                                    </div>



                                </div>
                            </div>
                        </div>

                </div>

                <div class="col-md-4 col-lg-4 col-sm-4">

                        <div class="widget-content widget-content-area br-4 p-0">
                            <div id="user-profile-card-3" class="card br-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6 class="mt-2">Subscription Price</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body text-center">

                                    <div class="usr-info-meta mt-4 mb-3">
                                        @subscriptionnotcancelled
                                        <h5 class="mb-1">${{ auth()->user()->plan->price }} {{ config('saas.stripe.currency') }}</h5>
                                        @endsubscriptionnotcancelled
                                        @subscriptioncancelled
                                        <h5 class="mb-1">N/A</h5>
                                        @endsubscriptioncancelled
                                    </div>


                                </div>
                            </div>
                        </div>

                </div>

                <div class="col-md-4 col-lg-4 col-sm-4">

                        <div class="widget-content widget-content-area br-4 p-0">
                            <div id="user-profile-card-3" class="card br-4">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6 class="mt-2">Next Billing Date</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body text-center">

                                    <div class="usr-info-meta mt-4 mb-3">
                                        @subscriptionnotcancelled
                                        <h5 class="mb-1">{{ $next_billing_date }}</h5>
                                        @endsubscriptionnotcancelled
                                        @subscriptioncancelled
                                        <h5 class="mb-1">N/A</h5>
                                        @endsubscriptioncancelled
                                    </div>


                                </div>
                            </div>
                        </div>

                </div>


            </div>



        <div class="row mt-5">


            <div class="col-md-12 col-lg-12 col-sm-12">

                <div class="card card-default">
                    <div class="card-body">

                        <h5 class="mt-2 mb-3">
                            Invoices
                        </h5>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Transaction #
                                </th>
                                <th>
                                    Payment
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Download
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>
                                        <p>
                                            {{ $invoice->date()->format('Y-m-d') }} <br />
                                        </p>

                                    </td>
                                    <td>
                                        <p>
                                            @if(config('saas.payment_gateway') == 'stripe')
                                                {{ $invoice->number }}
                                            @else
                                                {{ $invoice->id }}
                                            @endif
                                        </p>

                                    </td>
                                    <td>
                                        <p>
                                            @if(config('saas.payment_gateway') == 'stripe')
                                                ${{ number_format(($invoice->amount_paid/100),2,'.',',')}}
                                            @else
                                                {{ number_format(($invoice->amount/100),2,'.',',')}} {{ $invoice->currencyIsoCode }}
                                            @endif
                                        </p>

                                    </td>
                                    <td>
                                        @if(config('saas.payment_gateway','') == 'stripe')
                                            @if($invoice->paid)
                                                <span class="badge badge-success">@lang('paid')</span>
                                            @else
                                                <span class="badge badge-warning">@lang('pending')</span>
                                            @endif
                                        @else
                                            <span class="badge badge-success">@lang('paid')</span>
                                        @endif
                                    </td>
                                    <td>

                                        @if(config('saas.payment_gateway','') == 'stripe')

                                        <a href="{{ $invoice->invoice_pdf }}" class="btn btn-sm btn-default">@lang('download')</a>

                                        @else

                                            <a href="{{ route('account.download-invoice',$invoice->id) }}" class="btn btn-sm btn-default">@lang('download')</a>


                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>

            </div>

        </div>

    @endif

    </div>
</div>

@endsection
