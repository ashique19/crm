    <div class="col-sm-3 col-12 mb-sm-0"> 
        <div class="card">    
            <div class="card-body">
                        <ul class="list-unstyled">

                            @notsubscribed

                            <li><a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('plans.index'), 'btn-gradient-warning') }}" href="{{ route("plans.index") }}">Plans</a></li>

                            @endnotsubscribed
                            <li><a class="nav-link nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/overview'), 'btn-gradient-warning') }}" href="{{ route("account.overview") }}">Account Overview</a></li>

                            @if(config('saas.enable_two_factor'))
                                <li><a class="nav-link nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/twofactor'), 'btn-gradient-warning') }}" href="{{ route("account.twofactor.index") }}">Two Factor Auth</a></li>
                            @endif
                            
                                <li><a class="nav-link nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/password'), 'btn-gradient-warning') }}" href="{{ route("account.password.index") }}">Manage Password</a></li>                            

                            @subscribed
                            
                                         <li><a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/subscription/card'), 'btn-gradient-warning') }}" href="{{ route('account.subscription.card.index') }}">Update Credit Card</a></li>                            

                                        @subscriptionnotcancelled
                                            <li><a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/subscription/swap'), 'btn-gradient-warning') }}" href="{{ route('account.subscription.swap.index') }}">Change Plan</a></li>
                                            <li><a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/subscription/cancel'), 'btn-gradient-warning') }}" href="{{ route('account.subscription.cancel.index') }}">Cancel Subscription</a></li>
                                        @endsubscriptionnotcancelled
                                        @subscriptioncancelled
                                            <li><a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/subscription/resume'), 'btn-gradient-warning') }}" href="{{ route('account.subscription.resume.index') }}">Resume Subscription</a></li>
                                        @endsubscriptioncancelled


                            @endsubscribed

                        </ul>            
            </div>
        </div>            
    </div>