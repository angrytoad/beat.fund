@extends('layouts.app')

@section('title', 'Finishing setting up your label account')

@section('content')
    <div id="accept-invite" class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('layouts.flash_message')
                <div class="panel panel-default">
                    <div class="panel-heading">Finish setting up your label account.</div>
                    <div class="panel-body">
                        <p>
                            In order to finish setting up your account, please provide a password to secure your account with. Your
                            password must be at least 10 characters in length.
                        </p>
                        <form class="form-horizontal" method="POST" action="{{ route('label.accept_invite',$invite_code) }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xs-12 col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="control-label">Password</label>

                                    <div>
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <label for="password-confirm" class="control-label">Confirm Password</label>

                                    <div>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>

                            <hr />

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div>
                                        <div class="g-recaptcha" data-sitekey="6LcECUwUAAAAAJIRvPInYeHGtMWXouSJsbOeCJ1k"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6 text-center">
                                    <button class="btn btn-primary btn-lg">Finish creating account</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
