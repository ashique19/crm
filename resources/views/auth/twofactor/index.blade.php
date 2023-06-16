@extends('layouts.app')

@section('title')
    <title>Two Factor Authentication</title>
    <meta name="title" content="Two Factor Authentication">
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
@endsection

@section('splash')

<div class="page_header text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Two Factor Authentication</h1>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">@lang('menu.two_factor_auth')</div>
                    <div class="card-body">

                        <form action="{{ route('login.twofactor.verify') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="token" class="col-md-4 col-form-label text-md-right">@lang('token')</label>

                                <div class="col-md-6">
                                    <input id="token" type="number" class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}" name="token" required>

                                    @if ($errors->has('token'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('token') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('login')
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
