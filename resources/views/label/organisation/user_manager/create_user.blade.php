@extends('layouts.app_label')

@section('title', 'Create a user')

@section('content')
<div id="create-user" class="wide-container">
    @include('layouts.flash_message')
    {{ Breadcrumbs::render('label.organisation.user_manager.create_user') }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a user</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('label.organisation.user_manager.create_user') }}">
                        {{ csrf_field() }}

                        <p>
                            Setting up a new user to your label is easy, they will be sent an email link to allow them
                            to finish setting up their account once you create the user, once they are fully set up. The account
                            type of the user will govern what they can access within the label. If you'd like to modify the
                            role of a user you can do so in the <a href="{{route('label.organisation.user_manager')}}">User Manager.</a>
                        </p>

                        <div id="register-form-first-name" class="{{ $errors->has('first_name') ? ' has-error' : '' }}">
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
                        <div id="register-form-last-name" class="{{ $errors->has('last_name') ? ' has-error' : '' }}">
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




                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
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
                        <hr />
                        <div class="">
                            <h4>Choose account type</h4>
                            <p>
                                There are key differences between account types in the system, Editors can create, delete
                                and edit content that goes onto your store, but are unable to do things like setting custom
                                payout rates, modify accounts to be paid and so on. Managers in addition can set custom rates and modify
                                band/artist payment accounts on the system, as well as remove and add users. Admins can do everything.
                            </p>
                            <div class="form-check">
                                <input class="form-check-input" value="editor" type="radio" name="account_type" checked>
                                <label class="form-check-label">
                                    Editor
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="manager" type="radio" name="account_type">
                                <label class="form-check-label">
                                    Manager
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" value="admin" type="radio" name="account_type">
                                <label class="form-check-label">
                                    Admin
                                </label>
                            </div>
                        </div>
                        <hr />
                        <div class="">
                            <label class="control-label">Recaptcha</label>

                            <div>
                                <div class="g-recaptcha" data-sitekey="6LcECUwUAAAAAJIRvPInYeHGtMWXouSJsbOeCJ1k"></div>
                            </div>

                        </div>
                        <hr />
                        <div class="">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    Send user invite
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
@section('scripts')
    <script>

    </script>
@endsection