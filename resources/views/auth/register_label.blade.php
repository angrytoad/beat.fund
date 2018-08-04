@extends('layouts.app')

@section('title', 'Register your label')

@section('content')
    <div id="register-label" class="container">
        @include('layouts.flash_message')
        <div class="row">
            <form method="POST" action="{{ route('register-label') }}" autocomplete="off">
                {{ csrf_field() }}
                <div class="col-xs-12">
                    <h1>Set up your label</h1>
                    <hr />
                    <p class="lead">
                        Please complete both sections below to create your label and super admin account, please remember that initial
                        account created for your label will have <strong>ALL PERMISSIONS</strong> for administering accounts on the label.
                        Please make sure you choose a secure password and keep your credentials safe at all times.
                    </p>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Your Label</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Label Name</label>
                                <input class="form-control" type="text" name="label_name" placeholder="E.G. Factory Records" value="{{ old('label-name') }}" required autofocus autocomplete="off"/>
                            </div>
                            <hr />
                            <h4>Company Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                        <label>Company Name</label>
                                        <input class="form-control" type="text" name="company_name" value="{{ old('company_name') }}" required autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('company_number') ? ' has-error' : '' }}">
                                        <label>Company Number</label>
                                        <input class="form-control" type="text" name="company_number" value="{{ old('company_number') }}" required autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group{{ $errors->has('company_first_line') ? ' has-error' : '' }}">
                                        <label>First Address Line</label>
                                        <input class="form-control" type="text" name="company_first_line" value="{{ old('company_first_line') }}" required autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group{{ $errors->has('company_second_line') ? ' has-error' : '' }}">
                                        <label>Second Address Line (OPTIONAL)</label>
                                        <input class="form-control" type="text" name="company_second_line" value="{{ old('company_second_line') }}" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('company_postcode') ? ' has-error' : '' }}">
                                        <label>Postcode</label>
                                        <input class="form-control" type="text" name="company_postcode" value="{{ old('company_postcode') }}"  required autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('company_city') ? ' has-error' : '' }}">
                                        <label>City</label>
                                        <input class="form-control" type="text" name="company_city" value="{{ old('company_city') }}"  required autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('company_county') ? ' has-error' : '' }}">
                                        <label>County</label>
                                        <input class="form-control" type="text" name="company_county" value="{{ old('company_county') }}"  required autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('company_country') ? ' has-error' : '' }}">
                                        <label>Country</label>
                                        <input class="form-control" type="text" name="company_country" value="{{ old('company_country') }}"  required autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group{{ $errors->has('company_telephone') ? ' has-error' : '' }}">
                                        <label>Company Telephone Number (OPTIONAL)</label>
                                        <input class="form-control" type="text" name="company_telephone" value="{{ old('company_telephone') }}" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <div class="form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
                                        <label>Company Email</label>
                                        <input class="form-control" type="text" name="company_email" value="{{ old('company_email') }}" required autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Your Account Information</div>
                        <div class="panel-body">
                            <div class="row" id="register-form-name">
                                <div class="col-md-6">
                                    <div id="register-form-first-name" class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="first_name" class="control-label">First Name</label>

                                        <div>
                                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autocomplete="off">

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
                                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autocomplete="off">

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
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="off">

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
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">

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
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="control-label">Recaptcha</label>
                                    <div>
                                        <div class="g-recaptcha" data-sitekey="6LcECUwUAAAAAJIRvPInYeHGtMWXouSJsbOeCJ1k"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
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
                            </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-primary">
                                            Create Label Account
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection
