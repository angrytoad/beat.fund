@extends('email.layout.base')

@section('title', 'Your password has been updated')

@section('styling')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title">Hey <span class="highlight">{{ $user->first_name }},</span> <br /><small>your password has been updated</small></h1>
        <div>
            <p>
                If you did not request a password reset, I guess you're shit out of luck pal.
            </p>
            <p>
                Kind Regards, <br/>
                <strong>Beat Fund</strong>
            </p>
        </div>
    </div>
@endsection
