@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.flash_message')
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="control-label">First Name</label>

                                <div>
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="control-label">Last Name</label>

                                <div>
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">E-Mail Address</label>

                                <div>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
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

                            <div class="form-group">
                                <label for="password-confirm" class="control-label">Confirm Password</label>

                                <div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="control-label">Recaptcha</label>

                                <div>
                                    <div class="g-recaptcha" data-sitekey="6LcECUwUAAAAAJIRvPInYeHGtMWXouSJsbOeCJ1k"></div>
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terms_and_conditions">
                                    <label class="form-check-label" for="create_store_checkbox">
                                        I have and read and accept Beat Funds <a target="_blank" href="{{ route('store_terms_and_conditions') }}">Terms & Conditions.</a>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="privacy_policy">
                                    <label class="form-check-label" for="create_store_checkbox">
                                        I have and read and accept Beat Funds <a target="_blank" href="{{ route('privacy_policy') }}">Privacy Policy.</a>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
