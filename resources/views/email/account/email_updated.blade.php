@extends('email.layout.base')

@section('title', 'Your email has been updated')

@section('styling')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title">Hey <span class="highlight">{{ $user->first_name }},</span> <br /><small>your email has been updated</small></h1>
        <div>
            <p>
                Hi {{ $user->first_name }}, We're just sending you this email to confirm this as the new email address for your Beat Fund account.
                There is nothing more you need to do.
            </p>
            <p>
                Kind Regards, <br/>
                <strong>Beat Fund</strong>
            </p>
        </div>
    </div>
@endsection
