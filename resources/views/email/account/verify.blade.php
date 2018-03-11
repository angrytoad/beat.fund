@extends('email.layout.base')

@section('title', 'Welcome to Beat Fund, please verify your account.')

@section('styling')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title">Hey <span class="highlight">{{ $user->first_name }},</span> <br /><small>thanks for joining Beat Fund!</small></h1>
        <div>
            <p>
                Hi {{ $user->first_name }}, Thanks for signing up to Beat Fund, in order for you to finish setting up your account, please
                click the link below to verify your email address.
            </p>
            <p>
                <a href="{{ url('/account/verify/'.$user->email_verification->token) }}">Verify my account</a>
            </p>
            <p class="small">
                Having trouble clicking the link? Please use the following url: <br />{{ url('/account/verify/'.$user->email_verification->token) }}
            </p>
        </div>
    </div>
@endsection
