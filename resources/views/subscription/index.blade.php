@extends('layouts.app')

@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="description" content="{{ seo('description') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ seo('title') }}" />
    <meta property="og:description" content="{{ seo('description') }}">
    <meta property="og:type" content="website" />
@endsection

<!--Style--->
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
<style>
label {
    margin-bottom: 0rem;
}
.standard-cta p {
    font-size: 1em;
}
.invalid-feedback{
    display: block;
}
</style>
@endsection
<!--Close--->

@section('splash')

<div class="page_header text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Subscribe</h1>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')

<div class="card card-default">
    <div class="card-body">
        @if(config('saas.demo') && config('saas.payment_gateway') == 'stripe')
            <div class="alert alert-outline-danger">
                @lang('stripe_test_card') <br />
                @lang('more_info') <a target="_blank" href="https://stripe.com/docs/testing">on stripe.com</a>
            </div>
        @endif
        @if(config('saas.demo') && config('saas.payment_gateway') == 'braintree')
            <div class="alert alert-outline-danger">
                @lang('braintree_test_card') <br />
                @lang('more_info') <a target="_blank" href="https://developers.braintreepayments.com/guides/credit-cards/testing-go-live/php">on braintreepayments.com</a>
            </div>
        @endif

        <form method="POST" action="{{ route('subscription.store') }}" id="payment-form">
        @csrf
         <div class="new_form_impl">
            <div class="row form_new_sec_con">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Personal Details</h3>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                            <input type="hidden" name="sub_total" class="total_amount" value="{{ $plans[0]->price }}">
                            <label for="first_name">First Name</label>
                             <input type="text" id="first_name" name="user_name" class="form-control form-control-alternative  {{ $errors->has('user_name') ? ' is-invalid' : '' }}" value="{{ old('user_name') }}">
                            @if($errors->has('user_name'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('user_name') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                            <label for="last_name">Last Name</label>
                              <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                             @if($errors->has('last_name'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                          </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control" value="{{ old('company_name') }}">
                                 @if($errors->has('company_name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('company_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control phone" value="{{ old('phone') }}" >
                                @if($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                                @if($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="form-control">
                                @if($errors->has('city'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                            <label for="state">State/Province</label>
                            <input type="text" name="state" id="state" class="form-control form-control-sm" value="{{ old('state') }}">
                            @if($errors->has('state'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('state') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <select name="country" id="country" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if($errors->has('country'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{--<div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="coupon">Coupon</label>
                                <input type="text" id="coupon" name="coupon" class="form-control" value="{{ old('coupon') }}">
                                @if($errors->has('coupon'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('coupon') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div> --}}

                        <div class="col-lg-12">
                            <h3>Create Account</h3>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="user_email">E-Mail Address</label>
                                <input type="email" class="form-control" id="user_email" name="user_email" value="{{ old('user_email') }}" autocomplete="off">
                            </div>
                            @if($errors->has('user_email'))
                                <span class="invalid-feedback email_error" style="display: block;">
                                    <strong>{{ $errors->first('user_email') }}</strong>
                                </span>
                            @endif
                            <p id="user_email_not_exist" style="color: green; display: none;">Email available </p>
                            <p id="user_email_exist" style="color: red; display: none;">Email taken, please try other </p>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                            <label for="c_user_email">Confirm E-Mail Address</label>
                            <input type="email" class="form-control" id="c_user_email" name="user_email_confirmation" value="{{old('user_email_confirmation')}}" >
                            </div>
                            @if ($errors->has('c_user_email'))
                                <span class="invalid-feedback" style="display: block;">
                                <strong>{{ $errors->first('c_user_email') }}</strong>
                            </span>
                            @endif
                            <p id="email_mis_match" style="color: red; display: none;
                            ">Email doesn't match </p>
                            <p id="email_match" style="color: green; display: none;">Email verified </p>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12 psw_reload">
                            <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="user_password" class="form-control" id="password" value="" autocomplete="new-password" >
                            </div>
                            @if ($errors->has('user_password'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('user_password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12 psw_reload">
                            <div class="form-group">
                            <label for="c_password">Confirm Password</label>
                            <input type="password" name="user_password_confirmation" class="form-control" id="c_password"  >
                            </div>
                            <p id="mis_match" style="color: red;">Password doesn't match </p>
                            <p id="match" style="color: green;">Password verified </p>
                        </div>

                        @foreach ($plans as $key=>$plan)
                        @if(strtolower($plan->slug)==$plan_type)
                        @php
                        $current_plan = $plan
                        @endphp
                        @endif
                        <div class="col-lg-4 col-sm-4 col-12 che_bafs">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" value="{{ $plan->gateway_id }}" class="form-check-input plan_detail" name="plan" price="{{ $plan->price }}" text="{{ $plan->name }}" {{ strtolower($plan->name)==$plan_type?'checked':'' }} style="display: none;">
                              </label>
                            </div>
                        </div>
                        @endforeach
                         @if ($errors->has('plan'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('plan') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">

                 <div class="acc_summry_cl">

                    <h3>Summary</h3>
                    <hr>

                  <div class="table-responsive">
                  <table class="table dat_cl_data">
                      <tbody>
                        <tr>
                          <td>Package</td>
                          <td><span class="plan_name">{{ $current_plan->name }}</span></td>
                        </tr>
                        <tr>
                          <td>Duration</td>
                          <td>Monthly Subscription</td>
                        </tr>
                        <tr>
                          <th>Monthly Total</th>
                          <th>${{ $current_plan->price }}</th>
                        </tr>

                      </tbody>
                  </table>
                </div>

                </div>

                <h3>Payment <img width="100" src="https://s3.amazonaws.com/current-rms/9d01c770-2cf7-0135-7b52-12f3e469bf2a/attachments/257/original/cc.png"></h3>

                <div class="standard-cta p-2">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="hidden" class="form-check-input payment_type" value="stripe" name="payment_type" checked>
                      </label>

                       <div class="card_form">
                            <div class='form-row row'>
                                <div class='col-sm-12 form-group required'>
                                    <label class='control-label'>Name on Card</label>
                                     <input class='form-control' size='4' type='text'>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-sm-12 form-group required'>
                                    <label class='control-label'>Card Number</label>
                                    <input autocomplete='off' class='form-control card-number' type='text'>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-sm-6 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='number'>
                                </div>
                                <div class='col-sm-6 col-md-4 form-group expiration required'>

                                    <label class='control-label'>Exp. Month</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' type='number'>

                                </div>
                                <div class='col-sm-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Exp. Year</label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <p class="payment-status alert-danger alert" style="display: none;"></p>
                            </div>
                       </div>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="form-check mb-2">
                      <label class="form-check-label">
                        <input type="checkbox" id="accept" name="accept" class="form-check-input" value="1">I agree to the <a href="{{ route('terms') }}" target="_blank">Terms and Conditions</a>
                      </label>
                       @if($errors->has('accept'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('accept') }}</strong>
                        </span>
                        @endif
                    </div>
                     <button type="submit" id="confirm_payment" class="btn btn-block btn-primary">Confirm payment</button>
                </div>

                </div>
            </div>
         </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
 <script src="{{ asset('assets/plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var plan_price = $("input[name='plan']:checked").attr('price');
            $('.total_amount').val(plan_price);
            $('.phone').inputmask("(999) 999-9999");
            $('.card-number').inputmask("9999 9999 9999 9999");
            $('.card-expiry-month').inputmask("99");
            $('.card-expiry-year').inputmask("9999");
            $('.select_single').select2();
            $("#mis_match").hide();
            $("#match").hide();
            $("#c_password").keyup(function() {
              var user_pass = $("#password").val();
              var user_pass2 = $("#c_password").val();
              if(user_pass.length == 0) {
                $("#mis_match").hide();
                $("#match").hide();
              } else if (user_pass == user_pass2) {
                $("#mis_match").hide();
                $("#match").show();
              } else {
                $("#mis_match").show();
                $("#match").hide();
              }
            });

            $("#c_user_email").keyup(function() {
                check_email_confirm();
            });
            
            $("#user_email").keyup(function() {
                var user_email = $("#user_email").val();
                $('.email_error').hide();
                $.ajax({
                    url: "{{ route('subscription.validate_email') }}",
                    data: {email: user_email,_token: $('meta[name="csrf-token"]').attr('content') },
                    type: 'POST',
                    success:function(res){
                        var data = res.data;
                        if(data == 'user_email_exist'){
                            $('#user_email_exist').text(res.validator).show();
                            $('#user_email_not_exist').hide();
                        }
                        check_email_confirm();
                    }
                });
            });

            $('.payment_type').click(function(){
                var payment_type = $(this).val();
                if(payment_type == 'stripe'){
                    $('.card_form').show();
                }else{
                    $('.card_form').hide();
                }
            })
            $('.plan_detail').click(function(){
                var plan_id = $(this).val();
                var price = $(this).attr('price');
                var text = $(this).attr('text');
                $('.plan_name').text(text);
                $('.total').text(price);
                $('.total_amount').val(price);
                $('.sub_total_amount').text(price);
            })
        });
        function check_email_confirm(){
            var user_email = $("#user_email").val();
              var c_user_email = $("#c_user_email").val();
              if(user_email.length == 0) {
                $("#email_mis_match").hide();
                $("#email_match").hide();
              } else if (user_email == c_user_email) {
                $("#email_mis_match").hide();
                $("#email_match").show();
              } else {
                $("#email_mis_match").show();
                $("#email_match").hide();
              }
        }
    </script>
    @if(config('saas.payment_gateway') == 'stripe')

        <script src="https://checkout.stripe.com/checkout.js"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

        <script>
            Stripe.setPublishableKey('{{ config('services.stripe.key') }}');
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('#confirm_payment').removeAttr("disabled");
                    $(".payment-status").show().html(response.error.message);
                    $('#payment-form').css('opacity', '1');
                } else {
                    var form$ = $("#payment-form");
                    var token = response['id'];
                    form$.append("<input type='hidden' name='token' value='" + token + "' />");
                    form$.get(0).submit();
                }
            }
            $(document).ready(function() {
                $("#payment-form").submit(function(event) {
                    $('#confirm_payment').attr("disabled", "disabled");
                    $('#payment-form').css('opacity', '.5');
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                    return false;
                });
            });
        </script>
    @endif
    @if(config('saas.payment_gateway') == 'braintree')
        <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
        <script>
            var button = document.querySelector('#pay');
            braintree.setup("{{ Braintree_ClientToken::generate() }}", 'dropin', {
                container: 'dropin-container',
                onReady: function() {
                    console.log('zord');
                }
            });
        </script>
    @endif
@endsection
