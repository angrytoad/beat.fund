@extends('layouts.app')

@section('title', 'Verify your email')

@section('content')
    <div class="container" id="verification_required">
        <div class="col-md-8 col-md-offset-2">
            @include('layouts.flash_message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    Verify your account
                </div>
                <div class="panel-body">
                    <p>
                        Now that your account is set up, all we need you to do is verify your email with us before you can begin using Beat Fund.
                    </p>
                    <p>
                        When you created your account, we will have sent out an email to you that contains a verification link, please click it, you will then be free to
                        use Beat Fund.
                    </p>
                    <p>
                        If you're verification code has expired, please <a href="{{ route('account.resend_verification') }}">Click here</a> to resend your verification email.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        fbq('track', 'CompleteRegistration');
    </script>

@endsection