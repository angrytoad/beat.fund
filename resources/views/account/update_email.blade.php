@extends('layouts.app')

@section('content')
    <div class="container" id="verification_required">
        @include('layouts.flash_message')
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Update your email
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal col-md-6" method="POST" action="{{ route('account.update_email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                                @if ($errors->has('email'))
                                    <small class="form-text text-muted">{{ $errors->first('email') }}</small>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Confirm password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" autocomplete="new-password">
                                @if ($errors->has('password'))
                                    <small class="form-text text-muted">{{ $errors->first('password') }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Update Email
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Confirming your email
                    </div>
                    <div class="panel-body">
                        <p>
                            Once you enter a new email, we'll send out a confirmation to that address, this should happen
                            every time you update your email.
                        </p>
                        <p>
                            If for some reason you don't get a confirmation, check to see it hasn't accidentally gone into
                            your spam folder.
                        </p>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Your Email
                    </div>
                    <div class="panel-body">
                        <details>
                            <summary>Click to show email</summary>
                            <p><strong>{{ Auth::user()->email }}</strong></p>
                        </details>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection