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
              Hi {{ $user->first_name }}, We're just sending you this email to confirm that your account password has recently been updated.
              If you authorised this change, there is nothing else you need to do. If you did not approve this change please email us right away
              at <span class="link">support@beat.fund</span>.
          </p>
          <p>
              Kind Regards, <br/>
              <strong>Beat Fund</strong>
          </p>
        </div>
    </div>
@endsection
