@extends('layouts.app')

@section('title')
    <title>{{ seo('title') }}</title>
    <meta name="title" content="{{ seo('title') }}">
    <meta name="description" content="{{ seo('description') }}">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
    <meta property="og:title" content="{{ seo('title') }}" />
    <meta property="og:image" content="" />
    <meta property="og:description" content="{{ seo('description') }}">
    <meta property="og:type" content="website" />
@endsection


@section('splash')
<div class="page_header text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Contact Us</h1>
      </div>
    </div>
  </div>
</div>
{{--
<div class="row no-gutters" style="background:#A5B1A8;">

        <div class="col-lg-9" style="opacity:0.25;">
                <div id="gmaps-overlay" class="gmaps equalheight"></div>
    </div> <!-- end col -->

            <div class="col-lg-3">

                <!-- Office -->
                <div class="address-box-container equalheight">
                    <div class="address-container" data-background-image="{{ url('assets/images/our-office.jpg') }}" style="background-image: url(&quot;{{ url('assets/images/our-office.jpg') }}&quot;);">
                        <div class="office-address">
                            <h3>Our Office</h3>
                            <ul>
                            <li>2nd Ave Ne</li>
                                <li>St. Petersburg, Florida 33701</li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Office / End -->

            </div>
    </div> <!-- end col -->
--}}
@endsection


@section('content')
    <div class="row contact-page">
        <div class="col-md-4 col-sm-12">
            <div class="mb-5 wow fadeIn text-center animated animated" data-wow-delay="400ms" style="visibility: visible; animation-delay: 400ms;">
              <div class="mb-2">
                    <i class="fa fa-lightbulb-o" style="font-size:100px; color: #E08845;"></i>
              </div>
              <h3 class="mb-2 font-light2 darkcolor">Have a Suggestion?</h3>
              <p class="bottom20">Have a great idea you'd like us to know about? Make a suggestion! </p>
            </div>
            <hr>

            <div class="mb-5 wow fadeIn text-center animated animated" data-wow-delay="400ms" style="visibility: visible; animation-delay: 400ms;">
              <div class="mb-2">
                    <i class="fa fa-life-ring" style="font-size:100px; color: #45A099;"></i>
              </div>
              <h3 class="mb-2 font-light2 darkcolor">Need Support?</h3>
              <p class="bottom20">Couldn't find an answer to your question? No problem. We are standing by to help. </p>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <form method="post" action="{{ route('contact.store') }}">
                @csrf
                <!-- service-form -->
                <div class="service-form">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb10 ">
                            <div id="form-response"></div>
                        </div>

                        <div class="form-group col-lg-6">
                            <div class="input-group input-group-alternative">
                                <input placeholder="Name" id="name" type="text"
                                       class="form-control p-3 {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" value="{{ old('name') }}" required>
                                <input type="hidden" name="conversion_point" value="contact page">
                            </div>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback text-center">
                                        <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-lg-6">
                            <div class="input-group input-group-alternative">
                                <input placeholder="Email" id="email" type="email"
                                       class="form-control p-3 {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ old('email') }}" required>

                            </div>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback text-center">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-lg-12">
                            <div class="input-group input-group-alternative">
                                <input placeholder="Subject" id="subject" type="text"
                                       class="form-control p-3 {{ $errors->has('subject') ? ' is-invalid' : '' }}"
                                       name="subject" value="{{ old('subject') }}" >

                            </div>

                            @if ($errors->has('subject'))
                                <span class="invalid-feedback text-center">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-lg-12">

                        <textarea id="message"
                                  class="form-control form-control-alternative p-3 {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                  name="message" cols="50" rows="10" placeholder="Message"
                                  required>{{ old('message') }}</textarea>

                            @if ($errors->has('message'))
                                <span class="invalid-feedback text-center">
                                        <strong>{{ $errors->first('message') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-sm-12" id="reCaptcha">
                            <div class="g-recaptcha" data-sitekey="{{ setting('site.google_recaptcha_api_public_key') }}"></div>
                            <span class="wrong-error"></span>
                        </div>

                        <div class="form-group col-lg-12">
                            <input type="submit" class="btn btn-lg btn-primary mt-3 send-form"
                                   value="Send"/>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<!-- google maps api -->
<script src="//maps.google.com/maps/api/js?key={{ setting('site.google_map_key') }}"></script>
<!-- Gmaps file -->
<script src="assets/plugins/gmaps/gmaps.min.js"></script>
<!-- demo codes -->
<script src="assets/js/pages/gmaps.js"></script>

<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>


@if (setting('site.google_recaptcha_api_public_key'))
<script>
    $(document).ready(function() {
        // Contact mail

        $('.send-form').click(function (e) {
          //  console.log("yes"); return;
            e.preventDefault();
            var token = $('[name="_token"]').val();
            $('#reCaptcha .wrong-error').hide();
            var captcha = grecaptcha.getResponse();
            var $fieldInfo = $('#form-response');
            if (captcha.length){
                $.ajax({
                    url: "{{ route('reCaptcha') }}",
                    type: 'post',
                    data: {response: captcha, _token: token},
                    success: function (msg) {
                        if (msg.status) {
                            var name = $('[name="name"]').val(),
                                email = $('[name="email"]').val(),
                                subject = $('[name="subject"]').val(),
                                body = $('[name="message"]').val();
                            $.ajax({
                                url: "{{ route('contact.store') }}",
                                type: 'post',
                                data: {name: name, email: email, subject: subject, conversion_point:'contact page', message: body, _token: token},
                                beforeSend: function () {
                                    $('.contact-form').addClass('loading');
                                    $('.wrong-error').html('').hide();
                                },
                                success: function(data) {
                                    if (data.status) {
                                        $fieldInfo.removeClass('alert alert-danger').addClass('alert alert-success');
                                        $fieldInfo.html(data.msg).show();
                                        $('.form-control').val('');
                                        setTimeout(function(){$('#form-response .field-info').slideUp()}, 6000);
                                    } else {
                                        $.each(data.errors, function(key, value) {
                                            var parent = $('[name="' + key + '"]').parents('.form-group');
                                            $('.wrong-error', parent).html(value).show();
                                        });
                                    }
                                    $('.contact-form').removeClass('loading');
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    $fieldInfo.removeClass('alert-success').addClass('alert-danger');
                                    $fieldInfo.html(jqXHR.responseJSON).show();
                                    $.each(jqXHR.responseJSON.errors, function (key, item)
                                    {
                                        $fieldInfo.append("<li class='alert alert-danger'>"+item+"</li>")
                                    });
                                    setTimeout(function(){$('#form-response').slideUp()}, 6000);
                                }
                            });
                        } else {
                            $('#reCaptcha .wrong-error').show().html("Please refresh and try again.");
                        }
                    }
                });
            } else {
                $('#reCaptcha .wrong-error').show().html("Please fill in the capcha.");
            }
        });
    });
</script>
@else
<script type="text/javascript">
$(document).ready(function() {
    $('#msg').hide();
    $('.send-form').click(function(e){
    e.preventDefault();
    var name = $('[name="name"]').val(),
        email = $('[name="email"]').val(),
        subject = $('[name="subject"]').val(),
        body = $('[name="message"]').val(),
        token = $('[name="_token"]').val();
        var $fieldInfo = $('#form-response');
        $.ajax({
            url: "{{ route('contact.store') }}",
            type: 'post',
            dataType: 'json',
            data: {name: name, email: email, subject: subject, message: body, _token: token},
            beforeSend: function(){
                $('.contact-form').addClass('loading');
                $('.wrong-error').html('').hide();
            },
            success: function(data){
                if (data.status){
                    $fieldInfo.removeClass('alert-danger').addClass('alert-success');
                    $fieldInfo.html(data.msg).show();
                    $('.form-control').val('');
                    setTimeout(function(){$('#form-response').slideUp()}, 6000);
                } else {
                    $.each(data.errors, function(key, value) {
                        var parent = $('[name="' + key + '"]').parents('.form-group');
                        $('.wrong-error').addClass('red-font');
                        $('.wrong-error', parent).html(value).show();

                    });
                }
                $('.contact-form').removeClass('loading');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $fieldInfo.removeClass('alert-success').addClass('alert-danger');
                $fieldInfo.html(jqXHR.responseJSON).show();
                $.each(jqXHR.responseJSON.errors, function (key, item)
                {
                    $fieldInfo.append("<li class='alert alert-danger'>"+item+"</li>")
                });
                setTimeout(function(){$('#form-response').slideUp()}, 6000);
            }
        });
    });
});
</script>
@endif

@endsection
