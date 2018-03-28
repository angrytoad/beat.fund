@extends('layouts.app')

@section('content')
    <div class="container" id="verification_required">
        @include('layouts.flash_message')
        <div class="row">
            <div class="col-md-3">
                @include('layouts.menus.internal_menu')
            </div>
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update your password
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal col-xs-12" method="POST" action="{{ route('account.update_password') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="new-password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Enter new password">
                                @if ($errors->has('new_password'))
                                    <small class="form-text text-muted">{{ $errors->first('new_password') }}</small>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('confirm') ? ' has-error' : '' }}">
                                <label for="confirm">Confirm Password</label>
                                <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" placeholder="Confirm new password">
                                @if ($errors->has('new_password_confirmation'))
                                    <small class="form-text text-muted">{{ $errors->first('new_password_confirmation') }}</small>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Old password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" autocomplete="new-password">
                                @if ($errors->has('password'))
                                    <small class="form-text text-muted">{{ $errors->first('password') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Changing your password
                    </div>
                    <div class="panel-body">
                        <p>
                            Maintaining a strong password is critical for the security of your account.
                        </p>
                        <p>
                            If you doubt the strength of your password change it here.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
