@extends('email.layout.base')

@section('title', $LabelUserInvite->label->name.' have invited you to Beat Fund.')

@section('styling')
    <style>

    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title">Hey <span class="highlight">{{ $LabelUserInvite->first_name }},</span> <br /><small>you've been invited to Beat Fund!</small></h1>
        <div>
            <p>
                Hi {{ $LabelUserInvite->first_name }}, You've been invited to create an account for <strong>{{ $LabelUserInvite->label->name }}</strong> on
                Beat Fund. All you need to do is finish setting up your account by clicking the link below.
            </p>
            <p>
                This invite will expire aon <strong>{{ \Carbon\Carbon::parse($LabelUserInvite->created_at)->addDays(7)->toDayDateTimeString() }}</strong>
            </p>
            <p>
                <a href="{{ route('label.accept_invite',$LabelUserInvite->invite_code) }}">Finish set up</a>
            </p>
            <p class="small">
                Having trouble clicking the link? Please use the following url: <br />{{ route('label.accept_invite',$LabelUserInvite->invite_code) }}
            </p>
        </div>
    </div>
@endsection
