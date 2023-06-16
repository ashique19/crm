@extends('layouts.app')

@section('title')
    <title>Resend Activation Token</title>
    <meta name="title" content="Resend Activation Token"> 
    <meta name="author" content="{{ env('APP_DOMAIN') }}">
@endsection

@section('splash')

<div class="page_header text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Resend Activation Token</h1>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')


        <div class="container pt-lg-md bg-login ">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow border-0">

                        <div class="card-body px-lg-5 py-lg-5">

                            <form method="POST" action="{{ route('activation.resend.store') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <input placeholder="Email" id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    </div>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback text-center">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary my-4">Submit</button>
                                </div>
                                <br />
                                <br />
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>


@endsection
