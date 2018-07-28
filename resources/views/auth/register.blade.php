@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div id="register" class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-warning">
                <strong>
                <span>
                    If you are a label, you are in the wrong place! Please visit <a href="{{ route('beatfund_for_labels') }}">Beatfund For Labels</a> for more inforamation
                    on setting up a label account.
                </span>
                </strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div id="register-sample-artists" class="panel panel-default">
                <div class="panel-body">
                    <p>Check out some of the Artists already using Beat Fund!</p>
                    <div id="register-sample-artists-list">
                        @foreach(\App\Helpers\Helper::getArtistStoresSampler() as $store)
                            <a target="_blank" href="{{ route('artist.store', $store->slug) }}">
                                <div class="artist">
                                    <img src="{{ $store->downsizedAvatar() }}" />
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            @include('layouts.flash_message')
            <div class="panel panel-default">
                <div class="panel-heading">Register an account today!</div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="row" id="register-form-name">
                                <div class="col-md-6">
                                    <div id="register-form-first-name" class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
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
                                </div>
                                <div class="col-md-6">
                                    <div id="register-form-last-name" class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
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
                                        I have and read and accept Beat Funds <a target="_blank" href="https://termsfeed.com/terms-conditions/c26e18e24eb4e014fc316451d02c19ca">Terms & Conditions.</a>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="privacy_policy">
                                    <label class="form-check-label" for="create_store_checkbox">
                                        I have and read and accept Beat Funds <a target="_blank" href="https://www.iubenda.com/privacy-policy/85876449">Privacy Policy.</a>
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
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">Some information about your account:</div>
                <div class="panel-body">
                    <p>
                        With a Beat Fund account you'll have access to tons of features that let you both Purchase music and
                        create your own music store. The service <strong>will always be free</strong> at the point of use.
                    </p>
                    <p>
                        If you'd like to know more about whats planned for Beat Fund in the future, please check out our roadmap.
                    </p>
                    <a href="" class="text-muted">View Roadmap</a>
                </div>
            </div>
            <div class="panel panel-warning">
                <div class="panel-heading">Please Remember!</div>
                <div class="panel-body">
                    <p>
                        If you have any issues whatsoever, please let me know, via email, you can email
                        <strong>tom@beat.fund</strong> and that will go right to my personal email
                    </p>
                    <p>
                        As someone who cares deeply about user Privacy, no identifying information will ever be shared with
                        a third party other than what you give consent to make available (E.G. If you make a store page).
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
