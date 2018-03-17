@extends('layouts.app')

@section('content')
    <div class="container" id="verification_required">
        @include('layouts.flash_message')
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Enter verification code
                    </div>
                    <div class="panel-body">
                        <p>
                            If you have tried to add a mobile number to your account, you should have received a verification
                            code, please enter it below here.
                        </p>
                        <form class="form-horizontal col-xs-12" method="POST" action="{{ route('account.verify_mobile_number') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('verification_code') ? ' has-error' : '' }}">
                                <label for="mobile_number">Verification code</label>
                                <input type="text" class="form-control" name="verification_code" id="verification-code" placeholder="Enter verification code" autofocus>
                                @if ($errors->has('verification_code'))
                                    <small class="form-text text-muted">{{ $errors->first('verification_code') }}</small>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Verify mobile number
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection