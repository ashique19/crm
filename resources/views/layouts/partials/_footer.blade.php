<footer class="footer has-cards">

    <div class="container">
        <div class="row row-grid align-items-center my-md">
            <div class="col-lg-6 text-lg-center btn-wrapper">
                @if(config('saas.social.twitter'))
                <a title="@lang('saas.social.twitter')" target="_blank" href="{{ config('saas.social.twitter') }}" class="btn btn-neutral btn-icon-only btn-twitter btn-round btn-lg" data-toggle="tooltip">
                    <i class="fa fa-twitter-square"></i>
                </a>
                @endif
                @if(config('saas.social.facebook'))
                <a title="@lang('saas.social.facebook')" target="_blank" href="{{ config('saas.social.facebook') }}" class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip" >
                    <i class="fa fa-facebook-square"></i>
                </a>
                @endif
                @if(config('saas.social.instagram'))
                <a title="@lang('saas.social.instagram')" target="_blank" href="{{ config('saas.social.instagram') }}" class="btn btn-neutral btn-icon-only btn-instagram btn-lg btn-round" data-toggle="tooltip" >
                    <i class="fa fa-instagram"></i>
                </a>
                @endif
                @if(config('saas.social.github'))
                <a title="@lang('saas.social.github')" target="_blank" href="{{ config('saas.social.github') }}" class="btn btn-neutral btn-icon-only btn-github btn-round btn-lg" data-toggle="tooltip">
                    <i class="fa fa-github-square"></i>
                </a>
                @endif
            </div>
        </div>
        <hr>
        <div class="row align-items-center justify-content-md-between">
            <div class="col-lg-5 col-sm-12 col-md-12">
                <div class="copyright font-weight-bold">
                    &copy; {{ \Carbon\Carbon::now()->year }}
                    @if(config('company'))
                        <a href="{{ config('company_link') }}" target="_blank">{{ config('company') }}</a>
                    @endif

                    @if(config('vectors'))
                    |

                            <a target="_blank" href="https://www.freepik.com">Vectors by Freepik</a>
                    @endif
                </div>
            </div>
            <div class="col-lg-7 col-sm-12 col-md-12">
                <ul class="nav nav-footer font-weight-bold justify-content-end">
                    <li class="nav-item">
                        <a href="{{ route('about_us') }}" class="nav-link" >@lang('about_us')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('terms') }}" class="nav-link" >@lang('terms')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('policy') }}" class="nav-link" >@lang('policy')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('plans.index') }}" class="nav-link">@lang('pricing')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}" class="nav-link">@lang('contact')</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row row-grid text-center mt-5">
            <div class="col-lg-12">

                <ul class="list-inline payments">
                    <li>
                        <i class="pw pw-stripe"></i>
                    </li>
                    <li>
                        <i class="pw pw-braintree"></i>
                    </li>
                    <li>
                        <i class="pw pw-paypal-new"></i>
                    </li>
                    <li>
                        <i class="pw pw-visa"></i>
                    </li>
                    <li>
                        <i class="pw pw-mastercard"></i>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</footer>