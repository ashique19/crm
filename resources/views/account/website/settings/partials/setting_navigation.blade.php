    <div class="col-sm-3 col-12 mb-sm-0">
        <div class="card">
            <div class="card-body">
                        <ul class="list-unstyled">

                            <li><a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/website/settings/site'), 'btn-gradient-warning') }}" href="{{ route("account.website.settings.site") }}">Website Settings</a></li>

                            <li><a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/website/settings/general'), 'btn-gradient-warning') }}" href="{{ route("account.website.settings.general") }}">General Settings</a></li>

                            <li><a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/website/settings/tag'), 'btn-gradient-warning') }}" href="{{ route("account.website.settings.tag") }}">Tag Settings</a></li>
							
                            <li><a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ return_if(on_page('account/website/settings/mail'), 'btn-gradient-warning') }}" href="{{ route("account.website.settings.mail") }}">Mail Settings</a></li>							

                        </ul>
            </div>
        </div>
    </div>
